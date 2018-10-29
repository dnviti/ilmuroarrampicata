select concat(a.cognome,' ',a.nome) utente, 
	a.username, a.password, a.email, a.data_nascita
	r.descri ruolo,
	a.tessera_cai, a.sez_tessera, a.anno_tessera,
	s.username referente, a.datare, a.note
	c.tipo ult_pagamento, i.valore ult_valore, i.data ult_data
from users a
join users s on a.id_userre=s.id
join anagrafica_ruoli r on a.id_role=r.id
left join (select id_user, max(trunc(datare)) max_datare from registro_incassi group by id_user) k on k.id_user=a.id
left join (select id_user, trunc(datare) datare, max(id) max_id from registro_incassi group by id_user, trunc(datare)) y on y.id_user=a.id and k.max_datare=y.datare
left join registro_incassi i on y.max_id=i.id
left join anagrafica_incassi c on i.id_tipo=c.id
order by a.id