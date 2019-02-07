
SELECT A.texte,A.laDate, B.idAuteur from
        TouitesPrives
        INNER JOIN (SELECT * from Touites ) as A
                on A.idMsg = TouitesPrives.idMsgSource
        INNER JOIN (SELECT * from Touitos where id = :nous) as B
                on B.id = TouitesPrives.idAuteur

