-- Create the new movies table
CREATE TABLE IF NOT EXISTS `movies` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(200) NOT NULL,
    `description` text,
    `genre` varchar(100) NOT NULL,
    `age_rating` varchar(50) NOT NULL,
    `subtitle` varchar(50) NOT NULL,
    `release_date` date NOT NULL,
    `duration` varchar(50) NOT NULL,
    `trailer_url` varchar(255),
    `image_url` varchar(150) NOT NULL,
    `director` varchar(100),
    `actors` text,
    `language` varchar(100),
    `status` enum('showing','upcoming') NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Migrate data from film_available to movies
INSERT INTO movies (
    title, description, genre, age_rating, subtitle, 
    release_date, duration, trailer_url, image_url, 
    director, actors, language, status
)
SELECT 
    name, '', genre, age, sub,
    STR_TO_DATE(release_date, '%d/%m/%Y'), timeline, trailer, image,
    director, actor, language, 'showing'
FROM film_available;

-- Migrate data from film_upcoming to movies
INSERT INTO movies (
    title, description, genre, age_rating, subtitle,
    release_date, duration, trailer_url, image_url,
    status
)
SELECT 
    name, '', genre, age, sub,
    release_date, timeline, trailer, image,
    'upcoming'
FROM film_upcoming;

-- Keep the users table as is since it's already correct
-- Keep the carousel table as is since it's still needed

-- Add indexes for better performance
ALTER TABLE `movies` ADD INDEX `idx_status` (`status`);
ALTER TABLE `movies` ADD INDEX `idx_release_date` (`release_date`); 