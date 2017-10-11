--Establecer formato a dia mes anio
SET datestyle = dmy;

--FUNCION COMPROBAR fecha
CREATE OR REPLACE FUNCTION is_date(date character varying) RETURNS boolean as $$
DECLARE
  replaceDate character varying;
BEGIN

  if date like '____' or date like '__/__/____' THEN
    replaceDate := replace(date, '/', '');
    if (isnumeric(replaceDate)) THEN
      if date like '____' then
        RETURN  TRUE;
      elsif checkDate(date) THEN
        RETURN TRUE;
      ELSE
        RAISE EXCEPTION 'FORMATO FECHA INCORRECTO';
      END IF;
    ELSE
      RAISE EXCEPTION 'FECHA NO NUMERICA';
    end if;
  ELSE
    RAISE EXCEPTION 'FORMATO FECHA DEBE SER AAAA o DD/MM/AAAA';
  end if;
END;
$$ LANGUAGE plpgsql;
