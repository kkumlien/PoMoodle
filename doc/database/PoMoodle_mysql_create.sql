
-- DROP SCHEMA pomoodle;
CREATE SCHEMA pomoodle;
USE pomoodle;

CREATE TABLE `pm_sites` (
	`site_id`     INT NOT NULL AUTO_INCREMENT,
	`site_url`    VARCHAR(100) NOT NULL UNIQUE,
  `site_alias`  VARCHAR(100) NOT NULL UNIQUE,
	PRIMARY KEY (`site_id`)
);

CREATE TABLE pm_users (
	`user_id`   INT NOT NULL AUTO_INCREMENT,
	`user_name` VARCHAR(30) NOT NULL,
	`site_id`   INT NOT NULL,
	`role_code` VARCHAR(1) NOT NULL DEFAULT 'S', -- CHECK ('S', 'T'),
	PRIMARY KEY (user_id),
	UNIQUE (user_name, site_id)
);

CREATE TABLE pm_activities (
	`activity_id`         INT NOT NULL AUTO_INCREMENT,
	`user_id`             INT NOT NULL,
  `cm_id`               INT NOT NULL,
	`duration_in_minutes` INT NOT NULL,
	PRIMARY KEY (`activity_id`),
  UNIQUE (`user_id`, `cm_id`)
);

CREATE TABLE pm_course_compl_status (
  user_id                       INT NOT NULL,
  course_contents               JSON NOT NULL,
  activities_completion_status  JSON NOT NULL,
  PRIMARY KEY (`user_id`)
);

CREATE TABLE pm_t_rows (idx INT NOT NULL PRIMARY KEY);

INSERT INTO pm_t_rows
        SELECT 1000
  UNION SELECT 1001
  UNION SELECT 1002
  UNION SELECT 1003
  UNION SELECT 1004
  UNION SELECT 1005
  UNION SELECT 1006
  UNION SELECT 1007
  UNION SELECT 1008
  UNION SELECT 1009
;

INSERT INTO pm_t_rows
  SELECT CAST(idx AS SIGNED) idx FROM (
    SELECT (@rownum:=@rownum+1)-1 idx FROM pm_t_rows t1 JOIN pm_t_rows t2 JOIN pm_t_rows t3, (SELECT @rownum:=0) r
  ) x;

ALTER TABLE pm_users ADD CONSTRAINT `users_fk0` FOREIGN KEY (`site_id`) REFERENCES pm_sites(`site_id`);

ALTER TABLE pm_activities ADD CONSTRAINT `activities_fk0` FOREIGN KEY (`user_id`) REFERENCES pm_users(`user_id`);

ALTER TABLE pm_course_compl_status ADD CONSTRAINT `course_compl_status_fk0` FOREIGN KEY (`user_id`) REFERENCES pm_users (`user_id`);

CREATE OR REPLACE VIEW pm_activities_json_extract AS SELECT user_id,
  JSON_EXTRACT(activities_completion_status, CONCAT('$.statuses[', idx, '].cmid')) cmid
, JSON_EXTRACT(activities_completion_status, CONCAT('$.statuses[', idx, '].state')) state
, JSON_EXTRACT(activities_completion_status, CONCAT('$.statuses[', idx, '].timecompleted')) timecompleted
FROM pm_course_compl_status JOIN pm_t_rows
WHERE JSON_EXTRACT(activities_completion_status, CONCAT('$.statuses[', idx, '].cmid')) IS NOT NULL
;

CREATE OR REPLACE VIEW pm_activities_json AS SELECT a.user_id,
  CAST(CONCAT('{"statuses": [',
              GROUP_CONCAT(JSON_OBJECT(
                   'cmid', pa.cmid,
                   'state', pa.state,
                   'timecompleted', pa.timecompleted,
                   'activity_id', a.activity_id,
                   'duration_in_minutes', a.duration_in_minutes)
               SEPARATOR ', '), ']}')
       AS JSON) activities_with_duration
FROM pm_activities_json_extract pa JOIN pm_activities a ON (pa.user_id = a.user_id AND pa.cmid = a.activity_id)
GROUP BY a.user_id
;
