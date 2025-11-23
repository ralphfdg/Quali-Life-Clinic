<?php

class ReminderCommand extends CConsoleCommand
{
    public function run($args)
    {
        echo "--- Starting Appointment Reminder Job ---\n";
        
        // 1. Calculate "Tomorrow"
        $tomorrow = date('Y-m-d', strtotime('+1 day'));
        echo "Checking appointments for date: $tomorrow\n";

        // 2. Find appointments for tomorrow that haven't been reminded yet
        $criteria = new CDbCriteria;
        $criteria->addCondition("date(t.schedule_datetime) = :tomorrow");
        $criteria->compare('t.appointment_status_id', 1); // Only 'Scheduled' status
        $criteria->compare('t.sms_reminder_sent', 0); // Only if not sent yet
        $criteria->params[':tomorrow'] = $tomorrow;

        // We need patient details to send the SMS
        $appointments = Appointment::model()->with('patientAccount.user')->findAll($criteria);

        $count = 0;

        foreach($appointments as $appt) {
            // Safety Check: Ensure patient user data exists
            if (isset($appt->patientAccount) && isset($appt->patientAccount->user)) {
                $user = $appt->patientAccount->user;
                
                if (!empty($user->mobile_number)) {
                    // 3. Construct Message
                    $time = date('g:i A', strtotime($appt->schedule_datetime));
                    $msg = "Reminder: You have an appointment at Quali-Life Clinic tomorrow ($tomorrow) at $time. See you!";

                    // 4. Send SMS
                    if (SmsHelper::send($user->mobile_number, $msg)) {
                        echo " [OK] Sent to {$user->firstname} ({$user->mobile_number})\n";
                        
                        // 5. Mark as Sent in DB so we don't spam them
                        $appt->sms_reminder_sent = 1;
                        $appt->save(false); // save(false) skips validation for speed
                        $count++;
                    } else {
                        echo " [ERR] Failed to send to {$user->firstname}\n";
                    }
                } else {
                    echo " [SKIP] Patient {$user->firstname} has no mobile number.\n";
                }
            }
        }

        echo "--- Job Finished. Sent $count reminders. ---\n";
    }
}