
INSERT INTO `sites`(`site_id`, `site_url` ) values(1,'https://pomodoro-moodle.c9users.io/moodle');

INSERT INTO `users`( `user_id`, `user_name`, `site_id`, `role_code`) values(1,'leo',1,'S');
INSERT INTO `users`( `user_id`, `user_name`, `site_id`, `role_code`) values(2,'bikram',1,'S');
INSERT INTO `users`( `user_id`, `user_name`, `site_id`, `role_code`) values(3,'kamal',1,'S');
INSERT INTO `users`( `user_id`, `user_name`, `site_id`, `role_code`) values(4,'finn',1,'S');
INSERT INTO `users`( `user_id`, `user_name`, `site_id`, `role_code`) values(5,'michael',1,'T');

INSERT INTO `courses`  (`course_id`, `site_id`, `teacher_user_id`, `course_name`) values(1,1,5,'Team Project');

INSERT INTO `modules`(  `module_id`,`course_id`,`module_name`) values(1,1,'Week 1');
INSERT INTO `modules`(  `module_id`,`course_id`,`module_name`) values(2,1,'Week 2');
INSERT INTO `modules`(  `module_id`,`course_id`,`module_name`) values(3,1,'Week 3');
INSERT INTO `modules`(  `module_id`,`course_id`,`module_name`) values(4,1,'Week 4');
INSERT INTO `modules`(  `module_id`,`course_id`,`module_name`) values(5,1,'Week 5');

INSERT INTO `activities`(`activity_id`, `user_id`, `module_id`,`activity_name`,`completed_flag`,`duration_in_minutes`,`completed_timestamp`) values(1,4,1,'Project Proposal',true,60,'2017-11-20');
INSERT INTO `activities`(`activity_id`, `user_id`, `module_id`,`activity_name`,`completed_flag`,`duration_in_minutes`,`completed_timestamp`) values(2,4,2,'Requirements Specifications',true,90,'2017-11-18');
INSERT INTO `activities`(`activity_id`, `user_id`, `module_id`,`activity_name`,`completed_flag`,`duration_in_minutes`,`completed_timestamp`) values(3,4,3,'Technical Report',true,120,'2017-11-23');
