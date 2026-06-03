USE wisata_ku;

ALTER TABLE admins
  MODIFY role ENUM('super_admin', 'ticket_admin') NOT NULL DEFAULT 'ticket_admin';

UPDATE admins
SET role = 'super_admin'
WHERE username IN ('admin', 'superadmin') OR email IN ('admin@wisataku.com', 'superadmin@wisataku.com');

UPDATE admins
SET role = 'ticket_admin'
WHERE role NOT IN ('super_admin', 'ticket_admin');

INSERT IGNORE INTO admins (username, email, password, role)
VALUES
  ('superadmin', 'superadmin@wisataku.com', '$2y$10$ttK.CRRqNTOUx3LAEE5Cc.18DklGy/Wniq2W4GqoJ6jaBuEEytOEu', 'super_admin'),
  ('admin_tiket', 'admintiket@wisataku.com', '$2y$10$auxS3MSdqe6qqLV58hfumOChQyfQUmJAbO7VhWl8ILynEjcDHqHXy', 'ticket_admin');

UPDATE admins
SET password = '$2y$10$ttK.CRRqNTOUx3LAEE5Cc.18DklGy/Wniq2W4GqoJ6jaBuEEytOEu'
WHERE username = 'superadmin';

ALTER TABLE destinations
  ADD COLUMN IF NOT EXISTS admin_id INT DEFAULT NULL AFTER id;

CREATE INDEX IF NOT EXISTS idx_destinations_admin ON destinations (admin_id);
