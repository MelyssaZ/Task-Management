CREATE TABLE `task_manager`.`user` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `roleId` SMALLINT NOT NULL,
  `firstName` VARCHAR(50) NULL DEFAULT NULL,
  `middleName` VARCHAR(50) NULL DEFAULT NULL,
  `lastName` VARCHAR(50) NULL DEFAULT NULL,
  `username` VARCHAR(50) NULL DEFAULT NULL,
  `mobile` VARCHAR(15) NULL,
  `email` VARCHAR(50) NULL,
  `passwordHash` VARCHAR(32) NOT NULL,
  `registeredAt` DATETIME NOT NULL,
  `lastLogin` DATETIME NULL DEFAULT NULL,
  `intro` TINYTEXT NULL DEFAULT NULL,
  `profile` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `uq_username` (`username` ASC),
  UNIQUE INDEX `uq_mobile` (`mobile` ASC),
  UNIQUE INDEX `uq_email` (`email` ASC) );
CREATE TABLE `task_manager`.`task` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `userId` BIGINT NOT NULL,
  `createdBy` BIGINT NOT NULL,
  `updatedBy` BIGINT NOT NULL,
  `title` VARCHAR(512) NOT NULL,
  `description` VARCHAR(2048) DEFAULT NULL,
  `status` SMALLINT NOT NULL DEFAULT 0,
  `hours` FLOAT NOT NULL DEFAULT 0,
  `createdAt` DATETIME NOT NULL,
  `updatedAt` DATETIME NULL DEFAULT NULL,
  `plannedStartDate` DATETIME NULL DEFAULT NULL,
  `plannedEndDate` DATETIME NULL DEFAULT NULL,
  `actualStartDate` DATETIME NULL DEFAULT NULL,
  `actualEndDate` DATETIME NULL DEFAULT NULL,
  `content` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_task_user` (`userId` ASC),
  CONSTRAINT `fk_task_user`
    FOREIGN KEY (`userId`)
    REFERENCES `task_manager`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

ALTER TABLE `task_manager`.`task` 
ADD INDEX `idx_task_creator` (`createdBy` ASC);
ALTER TABLE `task_manager`.`task` 
ADD CONSTRAINT `fk_task_creator`
  FOREIGN KEY (`createdBy`)
  REFERENCES `task_manager`.`user` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `task_manager`.`task` 
ADD INDEX `idx_task_modifier` (`updatedBy` ASC);
ALTER TABLE `task_manager`.`task` 
ADD CONSTRAINT `fk_task_modifier`
  FOREIGN KEY (`updatedBy`)
  REFERENCES `task_manager`.`user` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
CREATE TABLE `task_manager`.`task_meta` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `taskId` BIGINT NOT NULL,
  `key` VARCHAR(50) NOT NULL,
  `content` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_meta_task` (`taskId` ASC),
  UNIQUE INDEX `uq_task_meta` (`taskId` ASC, `key` ASC),
  CONSTRAINT `fk_meta_task`
    FOREIGN KEY (`taskId`)
    REFERENCES `task_manager`.`task` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
CREATE TABLE `task_manager`.`tag` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(75) NOT NULL,
  `slug` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`));
CREATE TABLE `task_manager`.`task_tag` (
  `taskId` BIGINT NOT NULL,
  `tagId` BIGINT NOT NULL,
  PRIMARY KEY (`taskId`, `tagId`),
  INDEX `idx_tt_task` (`taskId` ASC),
  INDEX `idx_tt_tag` (`tagId` ASC),
  CONSTRAINT `fk_tt_task`
    FOREIGN KEY (`taskId`)
    REFERENCES `task_manager`.`task` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tt_tag`
    FOREIGN KEY (`tagId`)
    REFERENCES `task_manager`.`tag` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
CREATE TABLE `task_manager`.`activity` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `userId` BIGINT NOT NULL,
  `taskId` BIGINT NOT NULL,
  `createdBy` BIGINT NOT NULL,
  `updatedBy` BIGINT NOT NULL,
  `title` VARCHAR(512) NOT NULL,
  `description` VARCHAR(2048) DEFAULT NULL,
  `status` SMALLINT NOT NULL DEFAULT 0,
  `hours` FLOAT NOT NULL DEFAULT 0,
  `createdAt` DATETIME NOT NULL,
  `updatedAt` DATETIME NULL DEFAULT NULL,
  `plannedStartDate` DATETIME NULL DEFAULT NULL,
  `plannedEndDate` DATETIME NULL DEFAULT NULL,
  `actualStartDate` DATETIME NULL DEFAULT NULL,
  `actualEndDate` DATETIME NULL DEFAULT NULL,
  `content` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_activity_user` (`userId` ASC),
  CONSTRAINT `fk_activity_user`
    FOREIGN KEY (`userId`)
    REFERENCES `task_manager`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

ALTER TABLE `task_manager`.`activity` 
ADD INDEX `idx_activity_task` (`taskId` ASC);
ALTER TABLE `task_manager`.`activity` 
ADD CONSTRAINT `fk_activity_task`
  FOREIGN KEY (`taskId`)
  REFERENCES `task_manager`.`task` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `task_manager`.`activity` 
ADD INDEX `idx_activity_creator` (`createdBy` ASC);
ALTER TABLE `task_manager`.`activity` 
ADD CONSTRAINT `fk_activity_creator`
  FOREIGN KEY (`createdBy`)
  REFERENCES `task_manager`.`user` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `task_manager`.`activity` 
ADD INDEX `idx_activity_modifier` (`updatedBy` ASC);
ALTER TABLE `task_manager`.`activity` 
ADD CONSTRAINT `fk_activity_modifier`
  FOREIGN KEY (`updatedBy`)
  REFERENCES `task_manager`.`user` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
CREATE TABLE `task_manager`.`comment` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `taskId` BIGINT NOT NULL,
  `activityId` BIGINT NULL DEFAULT NULL,
  `title` VARCHAR(100) NOT NULL,
  `createdAt` DATETIME NOT NULL,
  `updatedAt` DATETIME NULL DEFAULT NULL,
  `content` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_comment_task` (`taskId` ASC),
  CONSTRAINT `fk_comment_task`
    FOREIGN KEY (`taskId`)
    REFERENCES `task_manager`.`task` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

ALTER TABLE `task_manager`.`comment` 
ADD INDEX `idx_comment_activity` (`activityId` ASC);
ALTER TABLE `task_manager`.`comment` 
ADD CONSTRAINT `fk_comment_activity`
  FOREIGN KEY (`activityId`)
  REFERENCES `task_manager`.`activity` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;