select
#concat('<img class="edit_row" src="/assets/third-part/open-iconic/svg/pencil.svg" alt="icon name">', '&nbsp;', '<img class="delete_row" src="/assets/third-part/open-iconic/svg/trash.svg" alt="icon name">') as azioni,
concat(concat('<a href="?p=7&ROWID=', a.id, '">'), concat(a.cognome, '</br>', a.nome), '</a>') as Utente, 
	/*
	a.username, 
	a.password, a.email, a.data_nascita,
	r.descri as ruolo,
	*/
	concat(a.tessera_cai, '</br>', a.anno_tessera) as Tessera_CAI, 
	a.sez_tessera as Sez_Tessera
	#a.anno_tessera as Anno_Tessera,
	#s.username as referente, l.datare, a.note,
	#c.tipo as Ult._mov., 
	#i.valore as Ult._val., 
	#DATE_FORMAT(i.data, "%d/%m/%Y") as Ult._Accesso
	#concat(c.tipo,' ',DATE_FORMAT(i.data, "%d/%m/%Y")) as Ult_Mov
from users a
join log_users l on a.id=l.id_user
join users s on l.id_userre=s.id
join anagrafica_ruoli r on a.id_role=r.id
left join (select id_user, max(truncate(data,0)) max_datare from registro_incassi group by id_user) k on k.id_user=a.id
left join (select id_user, truncate(data,0) as datare, max(id) max_id from registro_incassi group by id_user, truncate(data,0)) y on y.id_user=a.id and k.max_datare=y.datare
left join registro_incassi i on y.max_id=i.id
left join anagrafica_incassi c on i.id_tipo=c.id
order by a.cognome, a.nome