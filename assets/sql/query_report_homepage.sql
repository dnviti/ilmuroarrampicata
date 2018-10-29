select concat(a.cognome,' ',a.nome) as Utente,
i.tipo as Tipo,
DATE_FORMAT(r.data, "%d/%m/%Y") as Data,
r.valore as Valore
from anagrafica_utenti a
join registro_incassi r on r.id_utente=a.id
join anagrafica_incassi i on i.id=r.id_tipo