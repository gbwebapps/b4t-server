# Tabella globale delle 5 sezioni cardine del frontend
create table if not exists `b4t`.`sections` ( 
	`sections_id` int unsigned not null auto_increment, 
	`sections_title` varchar(255) not null,  
	`sections_description` text null, 
	`sections_image` varchar(255) null, 
	`sections_meta_slug` varchar(80) not null, 
	`sections_meta_title` varchar(80) not null, 
	`sections_meta_description` varchar(80) not null, 
	`sections_updated_at` datetime not null, 
	primary key (`sections_id`)
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# Questa tabella rappresenta l'anagrafica dei circuiti.
# table circuits
create table if not exists `b4t`.`circuits` ( 
	`circuits_id` int unsigned not null auto_increment, 
	`circuits_name` varchar(255) not null, 
	`circuits_address` varchar(255) not null, 
	`circuits_email` varchar(255) not null, 
	`circuits_phone` varchar(255) not null, 
	`circuits_opening_time` text null, 
	`circuits_short_description` text null, 
	`circuits_long_description` text null, 
	`circuits_created_at` datetime not null, 
	`circuits_updated_at` datetime null, 
	`circuits_deleted_at` datetime null, 
	primary key (`circuits_id`), 
	index (`circuits_name`), 
	index (`circuits_email`), 
	index (`circuits_phone`), 
	index (`circuits_created_at`), 
	index (`circuits_updated_at`), 
	index (`circuits_deleted_at`)
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# Questa tabella rappresenta i tipi di circuito, Auto, Moto, Kart, ecc.
# table circuits_types
create table if not exists `b4t`.`circuits_types` ( 
	`id` int unsigned not null auto_increment, 
	`type` varchar(60) not null, 
	primary key (`id`)
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# Questa tabella rappresenta i servizi che un circuito può offrire, Box, Telemetria, Drone, ecc.
# table circuits_services
create table if not exists `b4t`.`circuits_services` ( 
	`id` int unsigned not null auto_increment, 
	`service` varchar(60) not null, 
	`type_id` int unsigned not null, 
	primary key (`id`), 
	constraint FK_type_id_1 foreign key (type_id) references circuits_types(id) on update cascade on delete cascade
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# Questa è la tabella di join che consente ad un circuito di essere di più tipi. 
# table circuit_type
create table if not exists `b4t`.`circuit_type` ( 
	`id` int unsigned not null auto_increment, 
	`circuit_id` int unsigned not null, 
	`type_id` int unsigned not null, 
	primary key (`id`), 
	constraint FK_circuit_id_1 foreign key (circuit_id) references circuits(circuits_id) on update cascade on delete cascade, 
	constraint FK_type_id_2 foreign key (type_id) references circuits_types(id) on update cascade on delete cascade
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# Questa è la tabella di join che consente ad ogni circuito di poter offrire più servizi.
# table circuit_service
create table if not exists `b4t`.`circuit_service` ( 
	`id` int unsigned not null auto_increment, 
	`circuit_id` int unsigned not null, 
	`type_id` int unsigned not null, 
	`service_id` int unsigned not null, 
	primary key (`id`), 
	constraint FK_circuit_id_2 foreign key (circuit_id) references circuits(circuits_id) on update cascade on delete cascade, 
	constraint FK_type_id_3 foreign key (type_id) references circuits_types(id) on update cascade on delete cascade, 
	constraint FK_service_id_1 foreign key (service_id) references circuits_services(id) on update cascade on delete cascade
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# Questa tabella è l'anagrafica degli organizzatori.
# Qui vanno aggiunte le colonne per gestire l'auth.
# table organizers
create table if not exists `b4t`.`organizers` ( 
	`organizers_id` int unsigned not null auto_increment, 
	`organizers_name` varchar(255) not null, 
	`organizers_address` varchar(255) not null, 
	`organizers_vat` varchar(255) not null, 
	`organizers_email` varchar(255) not null, 
	`organizers_phone` varchar(255) not null, 
	`organizers_coins` int unsigned not null, 
	`organizers_short_description` text null, 
	`organizers_long_description` text null, 
	`organizers_password_hash` varchar(255) null unique, 
	`organizers_activation_hash` varchar(64) null unique, 
	`organizers_activation_expire` datetime null, 
	`organizers_token_hash` varchar(64) null unique, 
	`organizers_created_at` datetime not null, 
	`organizers_updated_at` datetime null, 
	`organizers_deleted_at` datetime null, 
	primary key (`organizers_id`), 
	index (`organizers_name`), 
	index (`organizers_vat`), 
	index (`organizers_email`), 
	index (`organizers_phone`), 
	index (`organizers_created_at`), 
	index (`organizers_updated_at`), 
	index (`organizers_deleted_at`)
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# Questa è la tabella di join che consente l'assegnazione di più circuiti ad ogni organizzatore.
# table organizer_circuit
create table if not exists `b4t`.`organizer_circuit` ( 
	`id` int unsigned not null auto_increment, 
	`organizer_id` int unsigned not null, 
	`circuit_id` int unsigned not null, 
	`type_id` int unsigned not null, 
	`coins` int unsigned not null,
	primary key (`id`), 
	constraint FK_organizer_id_1 foreign key (organizer_id) references organizers(organizers_id) on update cascade on delete cascade, 
	constraint FK_circuit_id_3 foreign key (circuit_id) references circuits(circuits_id) on update cascade on delete cascade, 
	constraint FK_type_id_4 foreign key (type_id) references circuits_types(id) on update cascade on delete cascade
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# Questa è la tabella che conserva gli eventi creati dall'organizzatore. 
# Conserviamo qui il prezzo di ogni evento (events_price), oppure demandiamo questa cosa alla tabella circuit_type?
# table events
create table if not exists `b4t`.`events` ( 
	`events_id` int unsigned not null auto_increment, 
	`events_organizer_id` int unsigned not null, 
	`events_circuit_id` int unsigned not null, 
	`events_type_id` int unsigned not null, 
	`events_name` varchar(255) not null, 
	`events_status` int unsigned not null default 2, 
	`events_short_description` text null, 
	`events_long_description` text null, 
	`events_created_at` datetime not null, 
	`events_updated_at` datetime null, 
	`events_deleted_at` datetime null, 
	primary key (`events_id`), 
	constraint FK_organizer_id_2 foreign key (events_organizer_id) references organizers(organizers_id) on update cascade on delete cascade, 
	constraint FK_circuit_id_4 foreign key (events_circuit_id) references circuits(circuits_id) on update cascade on delete cascade, 
	constraint FK_type_id_5 foreign key (events_type_id) references circuits_types(id) on update cascade on delete cascade, 
	index (`events_organizer_id`), 
	index (`events_circuit_id`), 
	index (`events_type_id`), 
	index (`events_name`), 
	index (`events_created_at`), 
	index (`events_updated_at`), 
	index (`events_deleted_at`)
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# Questa è la tabella che conserva i servizi che può offrire un evento (Caschi, guanti, affitti vari, ingressi in pista, ecc...)
# table events_services
create table if not exists `b4t`.`events_services` ( 
	`id` int unsigned not null auto_increment, 
	`service` varchar(60) not null, 
	primary key (`id`)
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# In questa tabella vengono allocati gli slots temporali per ogni data di uno stesso evento (20 minuti, 30 minuti, mezza giornata, ecc)
# table events_slots
create table if not exists `b4t`.`events_slots` ( 
	`id` int unsigned not null auto_increment, 
	`slot` varchar(60) not null, 
	primary key (`id`)
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# Qui vengono scritte le date di ogni evento.
# In questa tabella, con il tempo, vengono a crearsi molte date scadute.
# table events_date
create table if not exists `b4t`.`events_date` ( 
	`id` int unsigned not null auto_increment, 
	`event_id` int unsigned not null, 
	`date` datetime not null, 
	`slot_id` int unsigned not null, 
	`quantity` int unsigned not null, 
	`price` int unsigned not null, 
	primary key (`id`), 
	constraint FK_event_id_1 foreign key (event_id) references events(events_id) on update cascade on delete cascade, 
	constraint FK_slot_id_1 foreign key (slot_id) references events_slots(id) on update cascade on delete cascade
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# Tabella di join che consente ad una data di un evento, di avere più servizi, e ad un servizio di appartenere a più date dello stesso evento
# table event_service
create table if not exists `b4t`.`event_service` ( 
	`id` int unsigned not null auto_increment, 
	`events_date_id` int unsigned not null, 
	`service_id` int unsigned not null, 
	`price` int unsigned not null, 
	`mandatory` tinyint(1) not null default 0, 
	primary key (`id`), 
	constraint FK_events_date_id_1 foreign key (events_date_id) references events_date(id) on update cascade on delete cascade, 
	constraint FK_service_id_2 foreign key (service_id) references events_services(id) on update cascade on delete cascade
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# Tabella di join che consente ad un evento di avere più slots, e ad uno slot di essere assegnato a più eventi
# table event_slot
create table if not exists `b4t`.`event_slot` ( 
	`id` int unsigned not null auto_increment, 
	`event_id` int unsigned not null, 
	`slot_id` int unsigned not null, 
	primary key (`id`), 
	constraint FK_event_id_2 foreign key (event_id) references events(events_id) on update cascade on delete cascade, 
	constraint FK_slot_id_2 foreign key (slot_id) references events_slots(id) on update cascade on delete cascade
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# Tabella di store degli ordini
# table orders
create table if not exists `b4t`.`orders` ( 
	`orders_id` int unsigned not null auto_increment, 
	`orders_event_id` int unsigned not null, 
	`orders_quantity` int unsigned not null, 
	`orders_price` int unsigned not null, 
	`orders_created_at` datetime not null, 
	`orders_updated_at` datetime null, 
	`orders_deleted_at` datetime null, 
	primary key (`orders_id`), 
	constraint FK_event_id_3 foreign key (orders_event_id) references events(events_id) on update cascade on delete cascade, 
	index (`orders_event_id`), 
	index (`orders_created_at`), 
	index (`orders_updated_at`), 
	index (`orders_deleted_at`)
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# Tabella che conserva per ogni ordine, i servizi selezionati e il relativo prezzo imposto dall'organizzatore.
# table order_service
create table if not exists `b4t`.`order_service` ( 
	`id` int unsigned not null auto_increment, 
	`order_id` int unsigned not null, 
	`service_id` int unsigned not null, 
	`price` int unsigned not null, 
	primary key (`id`), 
	constraint FK_order_id_1 foreign key (order_id) references orders(orders_id) on update cascade on delete cascade, 
	constraint FK_service_id_3 foreign key (service_id) references events_services(id) on update cascade on delete cascade
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# La tabella delle transazioni, rappresenta i movimenti in coins che un organizzatore effettua 
# durante la vita del proprio account. Sono incluse la prima assegnazione, le uscite per la creazione di eventi ed eventuali riaccrediti.
# table transactions
create table if not exists `b4t`.`transactions` ( 
	`transactions_id` int unsigned not null auto_increment, 
	`transactions_organizer_id` int unsigned not null, 
	`transactions_reason_code` tinyint(1) not null, 
	`transactions_reason` varchar(255) not null, 
	`transactions_amount` int not null, 
	`transactions_balance` int not null, 
	`transactions_created_at` datetime not null, 
	primary key (`transactions_id`), 
	constraint FK_organizer_id_3 foreign key (transactions_organizer_id) references organizers(organizers_id) on update cascade on delete cascade, 
	index (`transactions_organizer_id`), 
	index (`transactions_reason_code`), 
	index (`transactions_created_at`)
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# Tabella che indica le transazioni legate alla creazione specifica di un evento.
# table transaction_event
create table if not exists `b4t`.`transaction_event` ( 
	`id` int unsigned not null auto_increment, 
	`transaction_id` int unsigned not null, 
	`event_id` int unsigned not null, 
	primary key (`id`), 
	constraint FK_transaction_id_1 foreign key (transaction_id) references transactions(transactions_id) on update cascade on delete cascade, 
	constraint FK_event_id_4 foreign key (event_id) references events(events_id) on update cascade on delete cascade
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# Questa tabella è l'anagrafica dei clienti.
# table members
create table if not exists `b4t`.`members` ( 
	`members_id` int unsigned not null auto_increment, 
	`members_firstname` varchar(255) not null, 
	`members_lastname` varchar(255) not null, 
	`members_address` varchar(255) not null, 
	`members_tax_code` varchar(16) not null, 
	`members_email` varchar(255) not null, 
	`members_phone` varchar(255) not null, 
	`members_image` varchar(255) null, 
	`members_status` int unsigned not null default 2, 
	`members_password_hash` varchar(255) null unique, 
	`members_activation_hash` varchar(64) null unique, 
	`members_activation_expire` datetime null, 
	`members_token_hash` varchar(64) null unique, 
	`members_created_at` datetime not null, 
	`members_updated_at` datetime null, 
	`members_deleted_at` datetime null, 
	primary key (`members_id`), 
	index (`members_firstname`), 
	index (`members_lastname`), 
	index (`members_tax_code`), 
	index (`members_email`), 
	index (`members_phone`), 
	index (`members_created_at`), 
	index (`members_updated_at`), 
	index (`members_deleted_at`)
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# La tabella delle news. Qui vengono allocate le news scritte dall'amministratore e quelle scritte dagli organizzatori.
# Le news scritte dall'amministratore avranno valore news_organizer_id = NULL e news_in_home 1.
# Le news scritte dall'organizzatore avranno valore news_organizer_id = id organizzatore e news_in_home 0.
# Di default le news dell'organizzatore appariranno nel proprio profilo, mentre quello dell'amministratore in home page.
# Cambiando il valore di news_in_home a 1 per un organizzatore, consentirà la presenza della news organizzatore in home page.
# table news
create table if not exists `b4t`.`news` ( 
	`news_id` int unsigned not null auto_increment, 
	`news_name` varchar(255) not null, 
	`news_short_description` text null, 
	`news_long_description` text null, 
	`news_organizer_id` int unsigned not null,
	`news_in_home` int unsigned not null default 2, 
	`news_status` int unsigned not null default 2, 
	`news_created_at` datetime not null, 
	`news_updated_at` datetime null, 
	`news_deleted_at` datetime null, 
	primary key (`news_id`), 
	-- constraint FK_organizer_id_4 foreign key (news_organizer_id) references organizers(organizers_id) on update cascade on delete cascade, 
	index (`news_name`), 
	index (`news_organizer_id`), 
	index (`news_in_home`), 
	index (`news_created_at`), 
	index (`news_updated_at`), 
	index (`news_deleted_at`)
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# Questa la tabella degli utenti masters e admins
# table users
create table if not exists `b4t`.`users` ( 
	`users_id` int unsigned not null auto_increment, 
	`users_firstname` varchar(255) not null, 
	`users_lastname` varchar(255) not null, 
	`users_email` varchar(255) not null, 
	`users_phone` varchar(255) not null, 
	`users_image` varchar(255) null, 
	`users_role` tinyint(1) not null, 
	`users_master` tinyint(1) not null default 2, 
	`users_password_hash` varchar(255) null unique, 
	`users_activation_hash` varchar(64) null unique, 
	`users_activation_expire` datetime null, 
	`users_token_hash` varchar(64) null unique, 
	`users_status` int unsigned not null default 2, 
	`users_created_at` datetime not null, 
	`users_updated_at` datetime null, 
	`users_deleted_at` datetime null, 
	primary key (`users_id`), 
	index (`users_firstname`), 
	index (`users_lastname`), 
	index (`users_email`), 
	index (`users_phone`), 
	index (`users_role`), 
	index (`users_created_at`), 
	index (`users_updated_at`), 
	index (`users_deleted_at`)
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# table meta_tags
# La tabella dei meta tags valida per organizers, circuits, events, news
# Allora andrebbero anche qua la protezione delle chiavi foranee
create table if not exists `b4t`.`meta_tags` ( 
	`meta_tags_id` int unsigned not null auto_increment, 
	`meta_tags_entity_id` int unsigned not null, 
	`meta_tags_entity` varchar(100) not null, 
	`meta_tags_slug` varchar(80) not null, 
	`meta_tags_title` varchar(80) not null, 
	`meta_tags_description` varchar(80) not null, 
	primary key (`meta_tags_id`)
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# table files
# La tabella dei files valida per organizers, circuits, events, news, members
# Allora andrebbero anche qua la protezione delle chiavi foranee
create table if not exists `b4t`.`files` ( 
	`files_id` int unsigned not null auto_increment, 
	`files_entity_id` int unsigned not null, 
	`files_entity` varchar(100) not null, 
	`files_name` varchar(255) not null, 
	`files_is_cover` enum('0', '1') default '0' not null, 
	primary key (`files_id`)
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# Tabella comments
# La tabella comments contiene i commenti che i members registrati effettuano sui vari eventi.
# Per poter commentare, un member deve essere registrato, ma non deve necessariamente aver acquistato un evento
create table if not exists `b4t`.`comments` ( 
	`comments_id` int unsigned not null auto_increment, 
	`comments_event_id` int unsigned not null, 
	`comments_member_id` int unsigned not null, 
	`comments_title` varchar(255) not null, 
	`comments_content` text not null, 
	`comments_status` int unsigned not null default 2, 
	`comments_created_at` datetime not null, 
	`comments_updated_at` datetime null, 
	`comments_deleted_at` datetime null, 
	primary key (`comments_id`), 
	-- constraint FK_event_id_5 foreign key (comments_event_id) references events(events_id) on update cascade on delete cascade, 
	-- constraint FK_member_id_1 foreign key (comments_member_id) references members(members_id) on update cascade on delete cascade, 
	index (`comments_event_id`), 
	index (`comments_member_id`), 
	index (`comments_created_at`), 
	index (`comments_updated_at`), 
	index (`comments_deleted_at`)
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# Tabella contacts
# La tabella contacts contiene tutte le richieste di informazioni provenienti dal form contacts
create table if not exists `b4t`.`contacts` ( 
	`contacts_id` int unsigned not null auto_increment, 
	`contacts_firstname` varchar(255) not null, 
	`contacts_lastname` varchar(255) not null, 
	`contacts_email` varchar(255) not null, 
	`contacts_phone` varchar(255) not null, 
	`contacts_message` text not null, 
	`contacts_created_at` datetime not null, 
	`contacts_deleted_at` datetime null, 
primary key (`contacts_id`), 
	index (`contacts_firstname`), 
	index (`contacts_lastname`), 
	index (`contacts_email`), 
	index (`contacts_phone`), 
	index (`contacts_created_at`), 
	index (`contacts_deleted_at`)
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;

# table sessions
# La tabella sessions conserva i dati delle sessioni per tutti i tipi di 
create table if not exists `b4t`.`sessions` ( 
	`sessions_id` int unsigned not null auto_increment, 
	`sessions_token_hash` varchar(64) not null, 
	`sessions_entity_id` int unsigned not null, 
	`sessions_entity` varchar(100) not null, 
	`sessions_expires_at` datetime not null, 
	primary key (`sessions_id`), 
	-- constraint FK_organizer_id_5 foreign key (sessions_entity_id) references organizers(organizers_id) on update cascade on delete cascade, 
	-- constraint FK_member_id_2 foreign key (sessions_entity_id) references members(members_id) on update cascade on delete cascade, 
	-- constraint FK_user_id_1 foreign key (sessions_entity_id) references users(users_id) on update cascade on delete cascade, 
	index (`sessions_token_hash`), 
	index (`sessions_entity_id`), 
	index (`sessions_entity`), 
	index (`sessions_expires_at`)
) ENGINE = InnoDB, CHARACTER SET = utf8mb4, COLLATE = utf8mb4_general_ci;