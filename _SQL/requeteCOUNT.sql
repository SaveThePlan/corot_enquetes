USE sondages;

SELECT p.libelle, count(DISTINCT r.id) compte
FROM proposition p
LEFT JOIN reponse r
ON r.id_proposition = p.id
WHERE p.id_question = 4
GROUP BY p.id
ORDER BY compte DESC;
