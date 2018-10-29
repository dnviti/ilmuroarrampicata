select concat(a.cognome,' ',a.nome) utente, 
	i.tipo, 
	r.data, r.valore, 
	s.username referente, r.note
from users a

join registro_incassi r on r.id_utente=a.id

join anagrafica_incassi i on i.id=r.id_tipo

join users s on r.id_userre=s.id
where trunc(r.data) between :Pxx_inizio and :Pxx_fine