CREATE OR REPLACE FUNCTION public.sinacentos(text)
  RETURNS text AS
$BODY$
select translate($1,'áéíóúÁÉÍÓÚäëïöüÄËÏÖÜ','aeiouAEIOUaeiouAEIOU');
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION public.sinacentos(text)
  OWNER TO postgres;