<?php

class ReminderCommand extends CConsoleCommand
{
    public function run($args)
    {
        echo "--- Starting Appointment Reminder Job ---\n";

        // 1. Calculate "Tomorrow"
        $tomorrow = date('Y-m-d', strtotime('+1 day'));
        $displayDate = date('F j, Y', strtotime('+1 day')); // e.g. "November 25, 2025"

        echo "Checking appointments for date: $tomorrow\n";

        // 2. Find appointments
        $criteria = new CDbCriteria;
        $criteria->addCondition("date(t.schedule_datetime) = :tomorrow");
        $criteria->compare('t.appointment_status_id', 1); // Scheduled
        $criteria->compare('t.sms_reminder_sent', 0);     // Not sent yet
        $criteria->params[':tomorrow'] = $tomorrow;

        // LOAD BOTH PATIENT AND DOCTOR DATA WITH ALIASES
        $appointments = Appointment::model()->with(array(
            'patientAccount' => array(
                'with' => array(
                    'user' => array('alias' => 'pUser')
                )
            ),
            'doctorAccount' => array(
                'with' => array(
                    'user' => array('alias' => 'dUser')
                )
            )
        ))->findAll($criteria);

        $count = 0;

        foreach ($appointments as $appt) {

            // Safety Check
            if (isset($appt->patientAccount->user) && isset($appt->doctorAccount->user)) {

                $patientUser = $appt->patientAccount->user;
                $doctorUser = $appt->doctorAccount->user;

                if (!empty($patientUser->mobile_number)) {

                    // 3. Construct Professional Message
                    $time = date('g:i A', strtotime($appt->schedule_datetime));
                    $drName = $doctorUser->lastname;
                    $patientName = ucfirst($patientUser->firstname); // Capitalize first letter

                    // TEMPLATE:
                    // Quali-Life: Dear [Name], reminder for your appointment tomorrow.
                    // Doc: Dr. [Name]
                    // Time: [Time]
                    $msg = "Quali-Life: Dear $patientName, this is a reminder for your appointment tomorrow ($displayDate).\n\n"
                        . "Dr. $drName\n"
                        . "Time: $time\n\n"
                        . "Please arrive 10 mins early.";

                    // 4. Send SMS
                    if (SmsHelper::send($patientUser->mobile_number, $msg)) {
                        echo " [OK] Sent to {$patientUser->firstname}\n";

                        $appt->sms_reminder_sent = 1;
                        $appt->save(false);
                        $count++;
                    } else {
                        echo " [ERR] Failed to send to {$patientUser->firstname}\n";
                    }
                }
            }
        }

        echo "--- Job Finished. Sent $count reminders. ---\n";
    }
}
