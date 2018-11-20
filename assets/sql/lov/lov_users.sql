select
    concat(nome, ' ', cognome) as d,
    id as r
from users
where obsoleto = 0
and username != 'admin';