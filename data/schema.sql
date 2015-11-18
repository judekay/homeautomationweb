CREATE DATABASE IF NOT EXISTS rcf;

USE rcf;


CREATE TABLE IF NOT EXISTS subgroups (
  subgroup_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  subgroup_name VARCHAR(50) NOT NULL UNIQUE ,
  active_status BOOLEAN DEFAULT 1,
  created_at DATETIME NOT NULL,
  modified_at DATETIME NOT NULL,
  PRIMARY KEY (subgroup_id)
);

CREATE TABLE IF NOT EXISTS memberships (
  membership_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  membership_type VARCHAR(30) NOT NULL,
  active_status BOOLEAN DEFAULT 1,
  created_at DATETIME NOT NULL,
  modified_at DATETIME NOT NULL,
  PRIMARY KEY (membership_id)
);

CREATE TABLE IF NOT EXISTS users_type (
  user_type_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_type VARCHAR(30) NOT NULL,
  active_status BOOLEAN DEFAULT 1,
  created_at DATETIME NOT NULL,
  modified_at DATETIME NOT NULL,
  PRIMARY KEY (user_type_id)
);

CREATE TABLE IF NOT EXISTS profiles (
  profile_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_type_id INT UNSIGNED NOT NULL,
  membership_id INT UNSIGNED NOT NULL,
  subgroup_id INT UNSIGNED NOT NULL,
  user_bio tinyTEXT,
  gender VARCHAR(20) DEFAULT NULL,
  profile_image_name VARCHAR(50) DEFAULT NULL,
  email VARCHAR(40) NOT NULL UNIQUE ,
  active_status BOOLEAN DEFAULT 1,
  created_at DATETIME NOT NULL,
  modified_at DATETIME NOT NULL,
  PRIMARY KEY (profile_id),
  CONSTRAINT fk_profiles_user_type_id FOREIGN KEY (user_type_id) REFERENCES users_type (user_type_id),
  CONSTRAINT fk_profiles_membership_id FOREIGN KEY (membership_id) REFERENCES memberships (membership_id),
  CONSTRAINT fk_profiles_subgroup_id FOREIGN KEY (subgroup_id) REFERENCES subgroups (subgroup_id)
);

CREATE TABLE IF NOT EXISTS users (
  user_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  profile_id INT UNSIGNED NOT NULL,
  username VARCHAR(40) NOT NULL,
  password VARCHAR(100) NOT NULL,
  access_token VARCHAR(100) NOT NULL,
  verification_code VARCHAR(200) NOT NULL,
  active_status BOOLEAN DEFAULT 1,
  created_at DATETIME NOT NULL,
  modified_at DATETIME NOT NULL,
  PRIMARY KEY (user_id),
  CONSTRAINT fk_users_profile_id FOREIGN KEY (profile_id) REFERENCES profiles (profile_id)
);

CREATE TABLE IF NOT EXISTS post_types (
  post_type_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  post_type VARCHAR(30) NOT NULL,
  active_status BOOLEAN DEFAULT 1,
  created_at DATETIME NOT NULL,
  modified_at DATETIME NOT NULL,
  PRIMARY KEY (post_type_id)
);

CREATE TABLE IF NOT EXISTS posts (
  post_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id INT UNSIGNED NOT NULL,
  post_type_id INT UNSIGNED NOT NULL,
  post_title VARCHAR(70) NOT NULL,
  post_content TEXT NULL,
  active_status BOOLEAN DEFAULT 1,
  created_at DATETIME NOT NULL,
  modified_at DATETIME NOT NULL,
  PRIMARY KEY (post_id),
  CONSTRAINT fk_posts_user_id FOREIGN KEY (user_id) REFERENCES users (user_id),
  CONSTRAINT fk_post_type_id FOREIGN KEY (post_type_id) REFERENCES post_types (post_type_id)
);

CREATE TABLE IF NOT EXISTS comments (
  comment_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  post_id INT UNSIGNED NOT NULL,
  comment_content TEXT NOT NULL,
  active_status BOOLEAN DEFAULT 1,
  created_at DATETIME NOT NULL,
  modified_at DATETIME NOT NULL,
  PRIMARY KEY (comment_id),
  CONSTRAINT fk_comments_post_id FOREIGN KEY (post_id) REFERENCES posts (post_id)
);

CREATE TABLE IF NOT EXISTS files (
  file_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  post_id INT UNSIGNED NOT NULL,
  file_name VARCHAR(40) NOT NULL,
  active_status BOOLEAN DEFAULT 1,
  created_at DATETIME NOT NULL,
  modified_at DATETIME NOT NULL,
  PRIMARY KEY (file_id),
  CONSTRAINT fk_files_post_id FOREIGN KEY (post_id) REFERENCES posts (post_id)
);







