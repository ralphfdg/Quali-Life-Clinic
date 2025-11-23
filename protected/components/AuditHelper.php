<?php

class AuditHelper
{
    public static function log($action, $entity, $targetId, $details = null)
    {
        try {
            // Check if AuditLog model exists before trying to save
            if(!class_exists('AuditLog')) return;

            $log = new AuditLog;
            $log->user_account_id = Yii::app()->user->isGuest ? 0 : Yii::app()->user->id;
            $log->action = $action;
            $log->target_entity = $entity;
            $log->target_id = $targetId;
            
            if(is_array($details) || is_object($details)) {
                $log->details = CJSON::encode($details);
            } else {
                $log->details = $details;
            }
            
            $log->ip_address = Yii::app()->request->userHostAddress;
            $log->timestamp = date('Y-m-d H:i:s');
            
            $log->save(false);
            
        } catch (Exception $e) {
            // Silently fail logging so we don't break the main app flow
            Yii::log("Audit Log Error: " . $e->getMessage(), 'error');
        }
    }
}