CREATE DATABASE IF NOT EXISTS home_automation;

USE home_automation;


CREATE TABLE IF NOT EXISTS user_type(
  user_type_id INT UNSIGNED AUTO_INCREMENT NOT NULL ,
  user_type_name VARCHAR(50) NOT NULL ,
  created_at DATETIME NOT NULL ,
  modified_at DATETIME NOT NULL,
  active_status BOOLEAN DEFAULT 1,
  PRIMARY KEY (user_type_id)
);

CREATE TABLE IF NOT EXISTS user(
  user_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
  user_type_id INT UNSIGNED NOT NULL ,
  username VARCHAR(50) NOT NULL ,
  password VARCHAR(50) NOT NULL ,
  access_token VARCHAR(100) NOT NULL,
  firstname VARCHAR(50) NOT NULL ,
  lastname VARCHAR(50) NOT NULL ,
  created_at DATETIME NOT NULL ,
  modified_at DATETIME NOT NULL ,
  active_status BOOLEAN DEFAULT 1,
  PRIMARY KEY (user_id),
  CONSTRAINT fk_user_user_type_id FOREIGN KEY (user_type_id) REFERENCES user_type(user_type_id)
);

CREATE TABLE IF NOT EXISTS device_type(
  device_type_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
  device_type_name VARCHAR(50) NOT NULL,
  created_at DATETIME NOT NULL,
  modified_at DATETIME NOT NULL,
  active_status BOOLEAN DEFAULT  1,
  PRIMARY KEY (device_type_id)
);


CREATE TABLE IF NOT EXISTS device_group(
  device_group_id INT UNSIGNED AUTO_INCREMENT NOT NULL ,
  device_group_name VARCHAR(100) NOT NULL,
  temperature_value INT(11) DEFAULT 30,
  device_group_details VARCHAR(200) NOT NULL,
  created_at DATETIME NOT NULL,
  modified_at DATETIME NOT NULL,
  active_status BOOLEAN DEFAULT 1,
  PRIMARY KEY (device_group_id)
);

CREATE TABLE IF NOT EXISTS device(
  device_id INT UNSIGNED AUTO_INCREMENT NOT NULL ,
  device_type_id INT UNSIGNED NOT NULL ,
  device_group_id INT UNSIGNED NOT NULL ,
  device_name VARCHAR(100) NOT NULL ,
  device_value INT UNSIGNED DEFAULT 0,
  created_at DATETIME NOT NULL,
  modified_at DATETIME NOT NULL,
  active_status BOOLEAN DEFAULT 1,
  PRIMARY KEY (device_id),
  CONSTRAINT fk_device_device_type_id FOREIGN KEY (device_type_id) REFERENCES device_type(device_type_id),
  CONSTRAINT fh_device_device_group_id FOREIGN KEY (device_group_id) REFERENCES device_group(device_group_id)

);


INSERT INTO user_type (user_type_id, user_type_name,created_at, modified_at,active_status)
VALUES (1, 'primary_user',NOW(), NOW(),1),
  (2, 'admin_user',NOW(), NOW(),1);

INSERT INTO device_type (device_type_id, device_type_name, created_at, modified_at, active_status)
    VALUES (1, 'BULB', NOW(), NOW(), 1),
      (2,'FAN', NOW(), NOW(), 1);

INSERT INTO device_group (device_group_id, device_group_name, temperature_value, device_group_details, created_at, modified_at, active_status)
VALUES (1, 'Living Room', 30, 'This group contains all the appliances in the living room', NOW(), NOW(),1),
  (2, 'Dining Room', 30, 'This group contains all the appliances in the Dining room', NOW(), NOW(), 1),
  (3, 'Master Bedroom', 50, 'This group contains all the appliances in the Master Bedroom', NOW(), NOW(), 1),
  (4, 'Bedroom1', 50, 'This group contains all the appliances in Bedroom1', NOW(), NOW(), 1),
  (5, 'Security Appliances', 30, 'This group contains all the appliances outside the house such as security light',NOW(), NOW(), 1);

INSERT INTO device (device_type_id, device_group_id, device_name, device_value, created_at, modified_at, active_status)
VALUES (1,1,'LIVINGROOMBULB1',0,NOW(),NOW(), 1),
  (2,1,'LIVINGROOMFAN',0,NOW(),NOW(),1),
  (1,2,'DININGROOMBULB1',0,NOW(),NOW(),1),
  (1,3,'MASTERBEDROOMBULB1',0,NOW(),NOW(),1),
  (1,4,'BEDROOM1BULB1',0,NOW(),NOW(),1),
  (1,5,'SECURITYBULB1',0,NOW(),NOW(),1),
  (1,5,'SECURITYBULB2',0,NOW(),NOW(),1);




# INSERT INTO device_group (device_group_id, device_group_name, temperature_value, device_group_details, created_at, modified_at, active_status)
#   VALUES (1, 'Living Room', 30, 'This group contains all the appliances in the living room', NOW(), NOW(),1),
#     (2, 'Dining Room', 30, 'This group contains all the appliances in the Dining room', NOW(), NOW(), 1),
#     (3, 'Kitchen', 50, 'This group contains all the appliances in the Kitchen room', NOW(), NOW(), 1),
#     (4, 'Master Bedroom', 50, 'This group contains all the appliances in the Master Bedroom', NOW(), NOW(), 1),
#     (5, 'Bedroom1', 50, 'This group contains all the appliances in Bedroom1', NOW(), NOW(), 1),
#     (6, 'Bedroom2', 50, 'This group contains all the appliances in Bedroom2', NOW(), NOW(), 1),
#     (7, 'Bedroom3', 50, 'This group contains all the appliances in Bedroom3', NOW(), NOW(), 1),
#     (8, 'Walkway', 50, 'This group contains all the appliances in the Walkway', NOW(), NOW(), 1),
#     (9, 'House Store', 50, 'This group contains all the appliances in the Store', NOW(), NOW(), 1),
#     (10, 'Security Appliances', 30, 'This group contains all the appliances outside the house such as security light',NOW(), NOW(), 1);
#
# INSERT INTO device (device_id, device_type_id, device_group_id, device_name, device_value, created_at, modified_at, active_status)
#   VALUES (1,1,1,'LIVINGROOMBULB1',0,NOW(),NOW(), 1),
#     (2,2,1,'LIVINGROOMFAN',0,NOW(),NOW(),1),
#     (3,1,2,'DININGROOMBULB1',0,NOW(),NOW(),1),
#     (4,2,2,'DININGROOMFAN',0,NOW(),NOW(),1),
#     (5,1,3,'KITCHENBULB1',0,NOW(),NOW(),1),
#     (6,1,4,'MASTERBEDROOMBULB1',0,NOW(),NOW(),1),
#     (7,1,5,'BEDROOM1BULB1',0,NOW(),NOW(),1),
#     (8,1,6,'BEDROOM2BULB1',0,NOW(),NOW(),1),
#     (9,1,7,'BEDROOM2BULB1',0,NOW(),NOW(),1),
#     (10,1,8,'WALKWAYBULB1',0,NOW(),NOW(),1),
#     (11,1,9,'HOUSESTOREBULB1',0,NOW(),NOW(),1),
#     (12,1,10,'SECURITYBULB1',0,NOW(),NOW(),1),
#     (13,1,10,'SECURITYBULB2',0,NOW(),NOW(),1),
#     (14,1,10,'SECURITYBULB2',0,NOW(),NOW(),1);

