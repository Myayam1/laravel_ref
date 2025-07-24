BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "cache" (
	"key"	varchar NOT NULL,
	"value"	text NOT NULL,
	"expiration"	integer NOT NULL,
	PRIMARY KEY("key")
);
CREATE TABLE IF NOT EXISTS "cache_locks" (
	"key"	varchar NOT NULL,
	"owner"	varchar NOT NULL,
	"expiration"	integer NOT NULL,
	PRIMARY KEY("key")
);
CREATE TABLE IF NOT EXISTS "failed_jobs" (
	"id"	integer NOT NULL,
	"uuid"	varchar NOT NULL,
	"connection"	text NOT NULL,
	"queue"	text NOT NULL,
	"payload"	text NOT NULL,
	"exception"	text NOT NULL,
	"failed_at"	datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "grade" (
	"id"	integer NOT NULL,
	"nama"	varchar NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "job_batches" (
	"id"	varchar NOT NULL,
	"name"	varchar NOT NULL,
	"total_jobs"	integer NOT NULL,
	"pending_jobs"	integer NOT NULL,
	"failed_jobs"	integer NOT NULL,
	"failed_job_ids"	text NOT NULL,
	"options"	text,
	"cancelled_at"	integer,
	"created_at"	integer NOT NULL,
	"finished_at"	integer,
	PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "jobs" (
	"id"	integer NOT NULL,
	"queue"	varchar NOT NULL,
	"payload"	text NOT NULL,
	"attempts"	integer NOT NULL,
	"reserved_at"	integer,
	"available_at"	integer NOT NULL,
	"created_at"	integer NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "migrations" (
	"id"	integer NOT NULL,
	"migration"	varchar NOT NULL,
	"batch"	integer NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "password_reset_tokens" (
	"email"	varchar NOT NULL,
	"token"	varchar NOT NULL,
	"created_at"	datetime,
	PRIMARY KEY("email")
);
CREATE TABLE IF NOT EXISTS "sessions" (
	"id"	varchar NOT NULL,
	"user_id"	integer,
	"ip_address"	varchar,
	"user_agent"	text,
	"payload"	text NOT NULL,
	"last_activity"	integer NOT NULL,
	PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "students" (
	"id"	integer NOT NULL,
	"nama"	varchar NOT NULL,
	"kelas"	varchar NOT NULL,
	"email"	varchar NOT NULL,
	"alamat"	text NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "users" (
	"id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"email"	varchar NOT NULL,
	"email_verified_at"	datetime,
	"password"	varchar NOT NULL,
	"remember_token"	varchar,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT)
);
INSERT INTO "grade" VALUES (1,'11 PPLG 2',NULL,NULL);
INSERT INTO "grade" VALUES (2,'11 PPLG 1',NULL,NULL);
INSERT INTO "grade" VALUES (3,'10 PPLG 2',NULL,NULL);
INSERT INTO "grade" VALUES (4,'10 PPLG 1',NULL,NULL);
INSERT INTO "migrations" VALUES (1,'0001_01_01_000000_create_users_table',1);
INSERT INTO "migrations" VALUES (2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO "migrations" VALUES (3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO "migrations" VALUES (4,'2024_10_14_025104_create_students_table',1);
INSERT INTO "migrations" VALUES (5,'2024_10_24_010507_create_grade_table',1);
INSERT INTO "sessions" VALUES ('RkQwfKPFfqMPeLyu2L2Bq2Co0t0UbzTDDlxsjZIG',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZFhmNXpYV2xyaVk5TFRPNXJlYnhKNFlXNzc1eU1nVjlBc3hqZ0czdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9iZWxlamFyLWxhcmF2ZWwudGVzdC9ncmFkZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1729733364);
INSERT INTO "students" VALUES (1,'Imam','11 PPLG 2','imamghozali97@gmail.com','Ngraji',NULL,NULL);
INSERT INTO "students" VALUES (2,'Muhadi','10 PPLG 1','muhadirr@gmail.com','Purworejo',NULL,NULL);
INSERT INTO "students" VALUES (3,'Supriyadi','11 PPLG 1','suprisup@gmail.com','Toroh Selatan',NULL,NULL);
INSERT INTO "students" VALUES (4,'Muhaimin','10 PPLG 2','muh41min@gmail.com','Nglejok',NULL,NULL);
INSERT INTO "students" VALUES (5,'Steven','10 PPPLG 1','steven443@yahoo.com','Pennsylvania',NULL,NULL);
CREATE UNIQUE INDEX IF NOT EXISTS "failed_jobs_uuid_unique" ON "failed_jobs" (
	"uuid"
);
CREATE UNIQUE INDEX IF NOT EXISTS "grade_nama_unique" ON "grade" (
	"nama"
);
CREATE INDEX IF NOT EXISTS "jobs_queue_index" ON "jobs" (
	"queue"
);
CREATE INDEX IF NOT EXISTS "sessions_last_activity_index" ON "sessions" (
	"last_activity"
);
CREATE INDEX IF NOT EXISTS "sessions_user_id_index" ON "sessions" (
	"user_id"
);
CREATE UNIQUE INDEX IF NOT EXISTS "students_email_unique" ON "students" (
	"email"
);
CREATE UNIQUE INDEX IF NOT EXISTS "users_email_unique" ON "users" (
	"email"
);
COMMIT;
