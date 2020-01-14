exec BuyerTable.sql;
exec BuyerPopulate.sql;

CREATE PROCEDURE selectBuyer @Name nvarchar(30)
AS
SELECT * 
FROM Buyers
WHERE cust_name = @Name
GO;

EXEC selectBuyer cust_name = "marco";