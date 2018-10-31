select concat(a.cognome,' ',a.nome) utente, 
	concat(i.tipo,' ', DATE_FORMAT(r.data, "%d/%m/%Y")) as 'Movim.', 
	concat(r.valore,' €') as 'Val.', 
	concat(s.cognome,' ',s.nome) referente, r.note
from users a
join registro_incassi r on r.id_user=a.id
join anagrafica_incassi i on i.id=r.id_tipo
join users s on r.id_userre=s.id
order by r.data desc