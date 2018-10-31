select concat(nome, ' ', cognome) as nome, username
from users
where username in('damiano.amici', 'francesco.angelucci', 'marco.busciantella');