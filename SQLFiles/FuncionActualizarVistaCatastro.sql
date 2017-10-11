--Procedimiento actualizar vista
CREATE OR REPLACE FUNCTION updatevcatastro (vc_ID integer,
                                            vc_EnArchiva character varying,
                                            vc_Fondo character varying, --Se le pasa directamente el ID || to_number(text, text)
                                            vc_Seccion character varying, --Se le pasa directamente el ID || to_number(text, text)
                                            vc_Serie character varying, --Se le pasa directamente el ID || to_number(text, text)
                                            vc_Tipo character varying,
                                            vc_Signatura character varying,
                                            vc_Titulo character varying,
                                            vc_Plano character varying,
                                            vc_Poligono character varying,
                                            vc_Fecha character varying,
                                            vc_FechaInicio character varying,
                                            vc_FechaFin character varying,
                                            vc_Deposito character varying,
                                            vc_Provincia character varying, --Se le pasa directamente el ID || to_number(text, text)
                                            vc_Municipio character varying, --Se le pasa directamente el ID || to_number(text, text)
                                            vc_Gerencia character varying,
                                            vc_PartidoJudicial character varying,
                                            vc_Numeral character varying,
                                            vc_CaracteristicasFisicas character varying,
                                            vc_Tamano character varying,
                                            vc_Procedencia character varying,
                                            vc_Autor character varying,
                                            vc_Observaciones text,
                                            vc_FechaDescripcion character varying,
                                            vc_NotaArchivero character varying,
                                            vc_NormasDescripcion integer, --Se le pasa directamente el ID || to_number(text, text)
                                            vc_NivelDescripcion character varying,
                                            vc_InstrumentosDescripcion character varying,
                                            vc_DocumentacionRelacionada character varying,
                                            vc_Disco character varying,
                                            vc_UbicacionMaestro text,
                                            vc_UbicacionComprimido text)
RETURNS character varying AS $$
DECLARE
  old "public"."1-3-5-Catastro"%ROWTYPE;
BEGIN
  SELECT * INTO old FROM "public"."1-3-5-Catastro" where "ID" = vc_ID;

  IF (vc_Fecha IS NULL OR is_date(vc_Fecha))
			and (vc_FechaInicio IS NULL or is_date(vc_FechaInicio))
			and (vc_FechaFin IS NULL or is_date(vc_FechaFin))
			and (vc_FechaDescripcion IS NULL or is_date(vc_FechaDescripcion)) THEN

    UPDATE "public"."1-3-5-Catastro" set "EnArchiva" = COALESCE(vc_EnArchiva::integer, old."EnArchiva"),
                                       "Fondo" = COALESCE(vc_Fondo::integer, old."Fondo"), --Se le pasa directamente el ID || to_number(text, text)
                                       "Seccion" = COALESCE(vc_Seccion::integer, old."Seccion"), --Se le pasa directamente el ID || to_number(text, text)
                                       "Serie" = COALESCE(vc_Serie::integer, old."Serie"), --Se le pasa directamente el ID || to_number(text, text)
                                       "Tipo" = COALESCE(vc_Tipo, old."Tipo"),
                                       "Signatura" = COALESCE(vc_Signatura, old."Signatura"),
                                       "Titulo" = COALESCE(vc_Titulo, old."Titulo"),
                                       "Plano" = COALESCE(vc_Plano, old."Plano"),
                                       "Poligono" = COALESCE(vc_Poligono, old."Poligono"),
                                       "Fecha" = COALESCE(vc_Fecha, old."Fecha"),
                                       "FechaInicio" = COALESCE(vc_FechaInicio, old."FechaInicio"),
                                       "FechaFin" = COALESCE(vc_FechaFin, old."FechaFin"),
                                       "Deposito" = COALESCE(vc_Deposito, old."Deposito"),
                                       "Provincia" = COALESCE(vc_Provincia::integer, old."Provincia"), --Se le pasa directamente el ID || to_number(text, text)
                                       "Municipio" = COALESCE(vc_Municipio::integer, old."Municipio"), --Se le pasa directamente el ID || to_number(text, text)
                                       "Gerencia" = COALESCE(vc_Gerencia, old."Gerencia"),
                                       "PartidoJudicial" = COALESCE(vc_PartidoJudicial, old."PartidoJudicial"),
                                       "Numeral" = COALESCE(vc_Numeral, old."Numeral"),
                                       "CaracteristicasFisicas" = COALESCE(vc_CaracteristicasFisicas, old."CaracteristicasFisicas"),
                                       "Tamano" = COALESCE(vc_Tamano, old."Tamano"),
                                       "Procedencia" = COALESCE(vc_Procedencia, old."Procedencia"),
                                       "Autor" = COALESCE(vc_Autor, old."Autor"),
                                       "Observaciones" = COALESCE(vc_Observaciones, old."Observaciones"),
                                       "FechaDescripcion" = COALESCE(vc_FechaDescripcion, old."FechaDescripcion"),
                                       "NotaArchivero" = COALESCE(vc_NotaArchivero, old."NotaArchivero"),
                                       "NormasDescripcion" = COALESCE(vc_NormasDescripcion::integer, old."NormasDescripcion"), --Se le pasa directamente el ID || to_number(text, text)
                                       "NivelDescripcion" = COALESCE(vc_NivelDescripcion, old."NivelDescripcion"),
                                       "InstrumentosDescripcion" = COALESCE(vc_InstrumentosDescripcion, old."InstrumentosDescripcion"),
                                       "DocumentacionRelacionada" = COALESCE(vc_DocumentacionRelacionada, old."DocumentacionRelacionada"),
                                       "Disco" = COALESCE(vc_Disco, old."Disco"),
                                       "UbicacionMaestro" = COALESCE(vc_UbicacionMaestro, old."UbicacionMaestro"),
                                       "UbicacionComprimido" = COALESCE(vc_UbicacionComprimido, old."UbicacionComprimido")
    WHERE "ID" = vc_ID;
		ELSE
				RAISE EXCEPTION '%', SQLERRM;
		END IF;
RETURN 'Actualizado';
EXCEPTION WHEN OTHERS THEN
    RAISE EXCEPTION '%', SQLERRM;
END;
$$ LANGUAGE plpgsql;
