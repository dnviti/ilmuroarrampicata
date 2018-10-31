select concat(a.cognome,' ',a.nome) as Utente,
i.tipo as Tipo,
DATE_FORMAT(r.data, "%d/%m/%Y") as Data,
r.valore as Valore
from users a
join registro_incassi r on r.id_user=a.id
join anagrafica_incassi i on i.id=r.id_tipo