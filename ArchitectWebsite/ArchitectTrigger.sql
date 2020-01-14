exec ArchitectTable.sql;
exec ArchitectPopulate.sql;

set serverouput on;

CREATE FUNCTION accountArchitect(arch_name VARCHAR2(30), phone_num VARCHAR2(13)) RETURNS INT
BEGIN
DECLARE account = VARCHAR2(43);
    SET account = CONCAT(arch_name, ' ', phone_num);
    RETURN account;
END;