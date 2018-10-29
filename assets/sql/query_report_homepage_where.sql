select concat(a.cognome,' ',a.nome) utente, i.tipo, r.data, r.valore
from anagrafica_utenti a
join registro_incassi r on r.id_utente=a.id
join anagrafica_incassi i on i.id=r.id_tipo
where truncate(r.data, 0) + i.gg_validita >= truncate(sysdate(), 0)