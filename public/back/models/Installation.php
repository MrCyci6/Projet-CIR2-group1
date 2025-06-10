<?php

    class Installation {
        public static function getByAnne() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT COUNT(id) as total, annee FROM installation GROUP BY annee;",
                    []
                );

                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result;
        }
        public static function getByRegion() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT COUNT(id) as total, r.code, r.denomination FROM installation i 
                    INNER JOIN localite l ON l.code_insee=i.code_insee 
                    INNER JOIN departement d ON d.code=l.code_departement 
                    INNER JOIN region r ON r.code=d.code_region 
                    GROUP BY r.code;",
                    []
                );

                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result;
        }

        public static function getSurfaceTotal() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT SUM(surface) as surface FROM installation;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result['surface'];
        }

        public static function getSurfaceAverage() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT SUM(surface) as surface FROM installation;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result['surface'];
        }

        public static function getProductionTotal() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT SUM(production_pvgis) as production FROM installation;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result['production'];
        }

        public static function getProductionAverage() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT AVG(production_pvgis) as production FROM installation;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result['production'];
        }
        
        public static function getPuissanceTotal() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT SUM(puissance_crete) as puissance FROM installation;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result['puissance'];
        }
        
        public static function getPuissanceAverage() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT AVG(puissance_crete) as puissance FROM installation;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result['puissance'];
        }

        public static function search($query, int $page, int $rows, $id_onduleur, $id_panneau, $code_departement, $annee) {
            try {
                $statement = Database::preparedQuery(
                    "SELECT i.*, om.denomination as onduleur, pm.denomination as panneau, l.denomination as localite, d.code as code_departement FROM installation i 
                    INNER JOIN onduleur o ON o.id=i.id_onduleur 
                    INNER JOIN onduleur_modele om ON om.id=o.id_modele 
                    INNER JOIN panneau p ON p.id=i.id_panneau 
                    INNER JOIN panneau_modele pm ON pm.id=p.id_modele
                    INNER JOIN localite l ON l.code_insee=i.code_insee
                    INNER JOIN departement d ON d.code=l.code_departement
                    INNER JOIN region r ON r.code=d.code_region
                    WHERE 1=1 ".
                    ($query != null ? " AND (
                        LOWER(pm.denomination) LIKE LOWER(CONCAT('%', ?, '%'))
                        OR LOWER(om.denomination) LIKE LOWER(CONCAT('%', ?, '%'))
                        OR LOWER(d.denomination) LIKE LOWER(CONCAT('%', ?, '%'))
                        OR LOWER(r.denomination) LIKE LOWER(CONCAT('%', ?, '%'))
                        OR CAST(l.cp AS VARCHAR(255)) LIKE LOWER(CONCAT('%', ?, '%'))
                    ) " : "").
                    ($id_onduleur != null ? "AND o.id=$id_onduleur " : "").
                    ($id_panneau != null ? "AND p.id=$id_panneau " : "").
                    ($code_departement != null ? "AND LOWER(d.code)=LOWER(?) " : "").
                    ($annee != null ? "AND i.annee=$annee " : "").
                    " ORDER BY i.id DESC
                    LIMIT $rows OFFSET ".($page-1)*$rows.";",
                    (
                        $code_departement != null ?
                        ($query != null ? [$query, $query, $query, $query, $query, $code_departement] : [$code_departement]) :
                        ($query != null ? [$query, $query, $query, $query, $query] : [])
                    )
                );

                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result;
        }
        
        public static function getSearchCount($query, int $page, int $rows, $id_onduleur, $id_panneau, $code_departement, $annee) {
            try {
                $statement = Database::preparedQuery(
                    "SELECT COUNT(i.id) as total FROM installation i 
                    INNER JOIN onduleur o ON o.id=i.id_onduleur 
                    INNER JOIN onduleur_modele om ON om.id=o.id_modele 
                    INNER JOIN panneau p ON p.id=i.id_panneau 
                    INNER JOIN panneau_modele pm ON pm.id=p.id_modele
                    INNER JOIN localite l ON l.code_insee=i.code_insee
                    INNER JOIN departement d ON d.code=l.code_departement
                    INNER JOIN region r ON r.code=d.code_region
                    WHERE 1=1 ".
                    ($query != null ? " AND (
                        LOWER(pm.denomination) LIKE LOWER(CONCAT('%', ?, '%'))
                        OR LOWER(om.denomination) LIKE LOWER(CONCAT('%', ?, '%'))
                        OR LOWER(d.denomination) LIKE LOWER(CONCAT('%', ?, '%'))
                        OR LOWER(r.denomination) LIKE LOWER(CONCAT('%', ?, '%'))
                        OR CAST(l.cp AS VARCHAR(255)) LIKE LOWER(CONCAT('%', ?, '%'))
                    ) " : "").
                    ($id_onduleur != null ? "AND o.id=$id_onduleur " : "").
                    ($id_panneau != null ? "AND p.id=$id_panneau " : "").
                    ($code_departement != null ? "AND LOWER(d.code)=LOWER(?) " : "").
                    ($annee != null ? "AND i.annee=$annee " : "").
                    " ORDER BY i.id ASC
                    LIMIT $rows OFFSET ".($page-1)*$rows.";",
                    (
                        $code_departement != null ?
                        ($query != null ? [$query, $query, $query, $query, $query, $code_departement] : [$code_departement]) :
                        ($query != null ? [$query, $query, $query, $query, $query] : [])
                    )
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result['total'] ?? 0;
        }

        public static function get(int $id) {
            try {
                $statement = Database::preparedQuery(
                    "SELECT i.*, l.denomination as localite, om.denomination as onduleur, pm.denomination as panneau, d.denomination as departement, d.code as code_departement FROM installation i
                    INNER JOIN localite l ON l.code_insee=i.code_insee
                    INNER JOIN departement d ON d.code=l.code_departement
                    INNER JOIN onduleur o ON o.id=i.id_onduleur
                    INNER JOIN onduleur_modele om ON o.id_modele=om.id 
                    INNER JOIN panneau p ON p.id=i.id_panneau
                    INNER JOIN panneau_modele pm ON p.id_modele=pm.id
                    WHERE i.id = $id;",
                    []
                );

                $result = $statement->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result;
        }

        public static function getCount() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT COUNT(*) as total FROM installation;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result["total"];
        }

        public static function getPageNumber(int $rows) {           
            return ceil(Installation::getCount()/$rows);
        }

        public static function getAll(int $page, int $rows) {
            try {
                $statement = Database::preparedQuery(
                    "SELECT i.*, om.denomination as onduleur, pm.denomination as panneau, l.denomination as localite from installation i 
                    INNER JOIN localite l ON l.code_insee=i.code_insee 
                    INNER JOIN onduleur o ON o.id=i.id_onduleur
                    INNER JOIN onduleur_modele om ON o.id_modele=om.id 
                    INNER JOIN panneau p ON p.id=i.id_panneau
                    INNER JOIN panneau_modele pm ON p.id_modele=pm.id
                    ORDER BY i.annee DESC, i.mois DESC
                    LIMIT $rows OFFSET ".($page-1)*$rows.";",
                    []
                );

                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result;
        }

        public static function getAggregated($annee, $code_departement) {
            try {
                $statement = Database::preparedQuery(
                    "SELECT d.code AS code_departement,
                        d.denomination AS nom_departement,
                        AVG(i.latitude) AS latitude,
                        AVG(i.longitude) AS longitude,
                        COUNT(i.id) AS nb_installations,
                        SUM(i.production_pvgis) AS production_totale,
                        SUM(i.puissance_crete) AS puissance_totale
                    FROM installation i
                    INNER JOIN localite l ON i.code_insee = l.code_insee
                    INNER JOIN departement d ON l.code_departement = d.code".
                    " WHERE 1=1 ".
                    ($annee == null ? "" : "AND i.annee=CAST($annee as INT) ").
                    ($code_departement == null ? "" : "AND d.code=? ").
                    "GROUP BY d.code, d.denomination;",
                    $code_departement != null ? [$code_departement] : []
                );

                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result;
        }

        public static function getAggregatedByBox(array $bbox, $annee, $code_departement) {
            try {
                $statement = Database::preparedQuery(
                    "SELECT i.id, i.latitude, i.longitude, i.puissance_crete, i.production_pvgis, l.denomination AS localite FROM installation i
                    INNER JOIN localite l ON i.code_insee = l.code_insee
                    INNER JOIN departement d ON d.code=l.code_departement
                    WHERE i.latitude BETWEEN ".$bbox[1]." AND ".$bbox[3]."
                    AND i.longitude BETWEEN ".$bbox[0]." AND ".$bbox[2].
                    ($annee == null ? "" : " AND i.annee=CAST($annee as INT) ").
                    ($code_departement == null ? "" : " AND d.code=? ").
                    ";",
                    $code_departement != null ? [$code_departement] : []
                );

                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result;
        }

        public static function remove(int $id) {
            try {
                Database::preparedQuery(
                    "DELETE FROM installation WHERE id=$id;",
                    []
                );
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }

            return true;
        }

        public static function add(
            int $puissance_crete, int $surface, int $pente, int $pente_optimum, int $orientation, int $orientation_optimum, 
            int $production_pvgis, string $political, int $annee, int $mois, float $latitude, float $longitude, 
            int $code_insee, $id_installateur, int $id_panneau, int $nb_panneau, int $id_onduleur, int $nb_onduleur
        ) {
            
            try {
                Database::preparedQuery(
                    "INSERT INTO installation(puissance_crete, surface, pente, pente_optimum, orientation, orientation_optimum, production_pvgis, political,
                    annee, mois, latitude, longitude, code_insee, id_installateur, id_panneau, nb_panneau, id_onduleur, nb_onduleur)
                    VALUES ($puissance_crete, $surface, $pente, $pente_optimum, $orientation, $orientation_optimum, $production_pvgis, ?,
                    $annee, $mois, $latitude, $longitude, $code_insee, ".($id_installateur == null ? "NULL" : "CAST($id_installateur as INT)").", $id_panneau, $nb_panneau, $id_onduleur, $nb_onduleur);",
                    [$policital]
                );
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }

            return true;
        }

        public static function update(
            int $id,
            int $puissance_crete, int $surface, int $pente, int $pente_optimum, int $orientation, int $orientation_optimum, 
            int $production_pvgis, string $political, int $annee, int $mois, float $latitude, float $longitude, 
            int $code_insee, $id_installateur, int $id_panneau, int $nb_panneau, int $id_onduleur, int $nb_onduleur
        ) {
            
            try {
                Database::preparedQuery(
                    "UPDATE installation 
                    SET puissance_crete=$puissance_crete, surface=$surface, pente=$pente, 
                    pente_optimum=$pente_optimum, orientation=$orientation, orientation_optimum=$orientation_optimum, 
                    production_pvgis=$production_pvgis, political=?, annee=$annee, mois=$mois, 
                    latitude=$latitude, longitude=$longitude, code_insee=$code_insee, ".($id_installateur == null ? "" : "id_installateur=CAST($id_installateur as INT), ")." 
                    id_panneau=$id_panneau, nb_panneau=$nb_panneau, id_onduleur=$id_onduleur, nb_onduleur=$nb_onduleur 
                    WHERE id=$id;",
                    [$political]
                );
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }

            return true;
        }
    }

?>