
CREATE TABLE `users` (
	`user_id` INT NOT NULL UNIQUE,
	`user_name` varchar(30) NOT NULL,
	`site_id` INT NOT NULL,
	`role_code` varchar(1) NOT NULL,
	PRIMARY KEY (user_id),
	UNIQUE (user_name, site_id)
);

CREATE TABLE `sites` (
	`site_id` INT NOT NULL AUTO_INCREMENT,
	`site_url` varchar(100) NOT NULL UNIQUE,
	PRIMARY KEY (`site_id`)
);

CREATE TABLE `modules` (
	`module_id` INT NOT NULL,
	`course_id` INT NOT NULL,
	`module_name` varchar(50) NOT NULL,
	PRIMARY KEY (`module_id`)
);

CREATE TABLE `activities` (
	`activity_id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`module_id` INT NOT NULL,
	`activity_name` varchar(50) NOT NULL,
	`completed_flag` BOOLEAN NOT NULL,
	`duration_in_minutes` INT NOT NULL,
	`completed_timestamp` TIMESTAMP,
	PRIMARY KEY (`activity_id`)
);

CREATE TABLE `courses` (
	`course_id` INT NOT NULL,
	`site_id` INT NOT NULL,
	`teacher_user_id` INT NOT NULL,
	`course_name` varchar(50) NOT NULL,
	PRIMARY KEY (`course_id`)
);

ALTER TABLE `users` ADD CONSTRAINT `users_fk0` FOREIGN KEY (`site_id`) REFERENCES `sites`(`site_id`);

ALTER TABLE `modules` ADD CONSTRAINT `modules_fk0` FOREIGN KEY (`course_id`) REFERENCES `courses`(`course_id`);

ALTER TABLE `activities` ADD CONSTRAINT `activities_fk0` FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`);

ALTER TABLE `activities` ADD CONSTRAINT `activities_fk1` FOREIGN KEY (`module_id`) REFERENCES `modules`(`module_id`);

ALTER TABLE `courses` ADD CONSTRAINT `courses_fk0` FOREIGN KEY (`site_id`) REFERENCES `sites`(`site_id`);

ALTER TABLE `courses` ADD CONSTRAINT `courses_fk1` FOREIGN KEY (`teacher_user_id`) REFERENCES `users`(`user_id`);
