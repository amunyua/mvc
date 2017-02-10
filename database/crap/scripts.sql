-- all masterfiles view
CREATE OR REPLACE VIEW all_masterfiles AS
select m.id,
concat(m.surname,' ',m.firstname,' ',m.middlename) as username,
m.id_no,
m.image_path,
m.user_role,
ct.created_at,
ct.city,
ct.postal_address,
ct.physical_address,
ct.email,
ct.phone_number
from masterfiles m
LEFT JOIN contacts ct ON ct.masterfile_id = m.id;