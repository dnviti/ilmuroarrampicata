select concat(a.cognome,' ',a.nome) as Utente,
i.tipo as Tipo,
DATE_FORMAT(r.data, "%d/%m/%Y") as Data,
concat(r.valore,' €') as Valore
from users a
join registro_incassi r on r.id_user=a.id
join anagrafica_incassi i on i.id=r.id_tipo
where round(truncate(date_add(truncate(r.data, 0),interval i.gg_validita day),0)/1000000,0) >=round(truncate(sysdate(), 0)/1000000,0)
order by r.data desc