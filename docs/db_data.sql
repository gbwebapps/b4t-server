INSERT INTO `sections` 
(`sections_id`, `sections_title`, `sections_description`, `sections_image`, `sections_meta_slug`, `sections_meta_title`, `sections_meta_description`, `sections_updated_at`) 
VALUES 
(1, 'We are introducing BOOK4TRACK', 'We are introducing BOOK4TRACK', null, 'slug', 'Meta Title Home Page', 'Meta Description Home Page', current_timestamp()), 
(2, 'Circuits', 'Descrizione circuiti', null, 'slug', 'Meta Title Circuiti', 'Meta Description Circuiti', current_timestamp()), 
(3, 'Organizers', 'Descrizione organizzatori', null, 'slug', 'Meta Title Organizzatori', 'Meta Description Organizzatori', current_timestamp()), 
(4, 'Events', 'Descrizione eventi', null, 'slug', 'Meta Title Eventi', 'Meta Description Eventi', current_timestamp()), 
(5, 'News', 'Descrizione news', null, 'slug', 'Meta Title News', 'Meta Description News', current_timestamp()), 
(6, 'Contacts', 'Descrizione contacts', null, 'slug', 'Meta Title Contatti', 'Meta Description Contatti', current_timestamp());

INSERT INTO `circuits_types` (`id`, `type`) 
VALUES (1, 'Auto'), (2, 'Moto'), (3, 'Kart'), (4, 'Mini auto'), (5, 'Mini moto');

INSERT INTO `circuits_services` (`id`, `service`, `type_id`) 
VALUES (1, 'Box auto', 1), (2, 'Box moto', 2), (3, 'Box kart', 3), (4, 'Box miniauto', 4), (5, 'Box minimoto', 5), 
	   (6, 'Telemetria auto', 1), (7, 'Telemetria moto', 2), (8, 'Telemetria kart', 3), (9, 'Telemetria miniauto', 4), (10, 'Telemetria minimoto', 5), 
	   (11, 'Drone auto', 1), (12, 'Drone moto', 2), (13, 'Drone kart', 3), (14, 'Drone miniauto', 4), (15, 'Drone minimoto', 5);

INSERT INTO `events_services` (`id`, `service`) 
VALUES (1, 'Affito Auto'), (2, 'Affito Moto'), (3, 'Affito Kart'), (4, 'Affito Caschi'), (5, 'Affitto Guanti'), (6, 'Ingresso Pista');

INSERT INTO `events_slots` (`id`, `slot`) 
VALUES (1, '20 minuti'), (2, '30 minuti'), (3, 'Mezza giornata'), (4, 'Giornata intera'), (5, 'Mattina'), (6, 'Pomeriggio');

INSERT INTO `users` (`users_id`, `users_firstname`, `users_lastname`, `users_email`, `users_phone`, `users_image`, `users_role`, `users_master`, `users_password_hash`, `users_activation_hash`, `users_activation_expire`, `users_token_hash`, `users_status`, `users_created_at`, `users_updated_at`) 
VALUES (1, 'Giorgio', 'Barone', 'gbwebapps@gmail.com', '+3519081161', null, 1, 1, '$2y$10$YbeUP26utqtuupfGHBFTdOreIo/DmSqJ.xzxfcEIbQOk5uRW5s3wK', null, null, null, 1, current_timestamp(), null), 
	   (2, 'Nazar', 'Pankiv', 'nazar.pankiv@kbrand.it', '+3711127373', null, 2, 2, '$2y$10$iyqSTP0XSLZC7WFgwCgccOVK/ZoGmTQxtYMuPBPtDTjAKSCahHcRC', null, null, null, 1, current_timestamp(), null);