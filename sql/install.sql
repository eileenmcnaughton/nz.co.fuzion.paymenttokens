CREATE TABLE `civicrm_payment_token` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Payment token ID',
  `contact_id` INT(10) UNSIGNED NOT NULL COMMENT 'FK to Contact ID',
  `code` VARCHAR(255) NOT NULL COMMENT 'Customer code returned from external provider' COLLATE 'utf8_unicode_ci',
  `created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expiry_date` DATETIME NULL DEFAULT NULL COMMENT 'Date this token expires',
  `email` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Customer-constituent Email address' COLLATE 'utf8_unicode_ci',
  `is_active` TINYINT(4) NULL DEFAULT '1' COMMENT 'is active',
  `ip_address` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Last IP from which this customer code was accessed or created' COLLATE 'utf8_unicode_ci',
  `reference` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Holds the part of the card number that may be retained or displayed' COLLATE 'utf8_unicode_ci',
  `payment_processor_id` INT(11) NULL DEFAULT NULL COMMENT 'Payment Processor ID',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `code` (`code`),
  INDEX `contact_id` (`contact_id`),
  CONSTRAINT `FK_payment_contact_id` FOREIGN KEY (`contact_id`) REFERENCES `civicrm_contact` (`id`)
)
COMMENT='Table to store token data'
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;
