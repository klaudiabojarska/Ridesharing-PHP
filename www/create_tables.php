CREATE TABLE Users (  `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY
                    , `username` VARCHAR(20)
                    , `first_name` VARCHAR(20)
                    , `last_name` VARCHAR(20)
                    , `email` VARCHAR(20)
                    , `address` VARCHAR(30)
                    , `birth_date` DATE
                    , `valid` BOOLEAN
                    , `password` VARCHAR(40)
                    , `salt` VARCHAR(20));

CREATE TABLE Cars ( `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY
                  , `car` VARCHAR(20)
                  , `driver_id` INT(6) UNSIGNED
                  , FOREIGN KEY (`driver_id`) REFERENCES Users(id) ON DELETE CASCADE);

CREATE TABLE Rides (  `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY
                    , `car_id` INT(6) UNSIGNED
                    , `date` DATE
                    , `hour` TIME
                    , `start` VARCHAR(20)
                    , `destination` VARCHAR(20)
                    , `places` INT(1)
                    , FOREIGN KEY (`car_id`) REFERENCES Cars(id) ON DELETE CASCADE);

CREATE TABLE Reservations (  `user_id` INT(6) UNSIGNED
                           , `ride_id` INT(6) UNSIGNED
                           , FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE
                           , FOREIGN KEY (ride_id) REFERENCES Rides(id) ON DELETE CASCADE);
