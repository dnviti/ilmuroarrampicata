select  i.tipo, 
	r.data, r.valore, 
	s.username referente, r.note
from users a

join registro_incassi r on r.id_utente=a.id

join anagrafica_incassi i on i.id=r.id_tipo

join users s on r.id_userre=s.id
where a.id=:Pyy_id
order by r.data desc