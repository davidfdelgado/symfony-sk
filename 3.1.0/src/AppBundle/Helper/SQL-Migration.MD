

UPDATE SHOP_Bestellungen as b LEFT JOIN AGENTUR_User as au on au_id = b_user set b_user = null WHERE (au_id is null and b_user > 0) or b_user = 0
UPDATE SHOP_Bestellungen set b_payed = null WHERE b_payed < "2010-01-01 00:00:01"
UPDATE SHOP_Bestellungen set b_booked = null WHERE b_booked < "2010-01-01 00:00:01"

ALTER TABLE SHOP_Position DROP p_adatum
ALTER TABLE AGENTUR_Login ENGINE=INNODB
ALTER TABLE AGENTUR_Chat_Betreff ENGINE=INNODB
ALTER TABLE AGENTUR_Chat ENGINE=INNODB
ALTER TABLE ARTIKEL ENGINE=INNODB

ALTER TABLE sk_new.ARTIKEL_Kategorie MODIFY a_k_anbieter_id INT(11)
UPDATE ARTIKEL_Kategorie set a_k_anbieter_id = NULL WHERE a_k_anbieter_id < 1
UPDATE ARTIKEL_Kategorie set a_k_vtext = NULL WHERE a_k_vtext = 0
UPDATE ARTIKEL_Kategorie set a_k_rtext = NULL WHERE a_k_rtext = 0
UPDATE ARTIKEL_Kategorie set a_k_zusatz = NULL WHERE a_k_zusatz = 0
DELETE from KATEGORIE_Zusatz where akz_id = 0

