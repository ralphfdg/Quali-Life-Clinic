<?php

class AuditHelper
{
    /**
     * Logs a user action.
     * Added $actorId param to handle "Login" events where session isn't ready yet.
     */
    public static function log($action, $entity, $targetId, $details = null, $actorId = null)
    {
        try {
            if (!class_exists('AuditLog')) return;

            $log = new AuditLog;
            
            // FIX: If explicit Actor ID is provided, use it. Otherwise check session.
            if ($actorId !== null) {
                $log->user_account_id = (int)$actorId;
            } else {
                $log->user_account_id = Yii::app()->user->isGuest ? 0 : Yii::app()->user->id;
            }
            
            $log->action = $action;
            $log->target_entity = $entity;
            $log->target_id = $targetId;
            
            if (is_array($details) || is_object($details)) {
                $log->details = CJSON::encode($details);
            } else {
                $log->details = $details;
            }
            
            $log->ip_address = Yii::app()->request->userHostAddress;
            $log->timestamp = date('Y-m-d H:i:s');
            
            $log->save(false);
            
        } catch (Exception $e) {
            Yii::log("Audit Log Error: " . $e->getMessage(), 'error');
        }
    }
}