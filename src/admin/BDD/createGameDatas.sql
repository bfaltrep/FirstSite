INSERT INTO HaAPlaceLogoEffect (`PLE_name`,`PLE_file_name`) VALUES
    ('b_book','b_book.png'),
    ('w_book','w_book.png'),
    ('b_brain','b_brain.jpg'),
    ('w_brain','w_brain.png'),
    ('b_dollar','b_dollar.jpg'),
    ('w_dollar','w_dollar.jpg'),
    ('b_gun','b_gun.png'),
    ('w_gun','w_gun.png'),
    ('b_heart','b_heart.jpg'),
    ('w_heart','w_heart.jpg'),
    ('b_lens','b_lens.png'),
    ('w_lens','w_lens.png'),
    ('b_pentagram','b_pentagram.png'),
    ('w_pentagram','w_pentagram.png'),
    ('b_profil','b_profil.png'),
    ('w_profil','w_profil.png'),
    ('b_scroll','b_scroll.jpg'),
    ('w_scroll','w_scroll.jpg'),
    ('b_star','b_star.jpg'),
    ('w_star','w_star.jpg');

 -- une seule image pour le moment, il faudra refaire ces insertions avec les bonnes images à l'avenir

INSERT INTO HaADistrictPlace (`DP_name`,`DP_description_action`,`DP_description`,`DP_image`,`DP_logo_1`,`DP_logo_2`,`DP_stable`) VALUES
    ('Gare','','','p_station.jpeg','b_pentagram','b_gun',1),
    ('Journal','','','p_newspaper.jpeg','b_dollar','b_lens',1),
    ('Boutique de souvenirs','Achat','Au lieu de faire une rencontre ici, vous pouvez piocher 3 objets uniques et acheter l''un d''eux à son prix indiqué. Défaussez les deux autres objets','p_giftShop.jpg','w_pentagram','b_gun',1),
    ('Banque d''Arkham','Prêt Bancaire','Au lieu de faire une rencontre ici, vous pouvez prendre un prêt bancaire si vous n''en avez pas déjà un','b_bank.jpg','w_dollar','b_star',1),
    ('Asile d''Arkham','Soins Psychiatriques','Au lieu de faire une rencontre ici, vous pouvez récupérer de la santé mentale en recevant des soins psychiatriques. Vous pouvez récupérer 1 Santé Mentale gratuitement ou payer 2$ pour restaurer votre Santé Mentale au maximum','p_asylum.jpg','w_brain','b_lens',1),
    ('Square de L''Indépendance','','','p_square.jpg','b_lens','b_pentagram',0),
    ('Relais Routier de Hibb','','','p_roadStop.jpg','b_dollar','b_gun',0),
    ('Restaurant De Velma','','','p_restaurant.jpg','b_dollar','b_heart',1),
    ('Poste de Police','Adjoint','Au lieu de faire une rencontre ici, vous pouvez dépenser des trophées de monstres pour un total de 10 force, 2 trophées de portail, ou des trophées de monstres pour un total de 5 en force, et un trophée de portail pour devenir l''Adjoint au Shérif d''Arkham. Prenez la carte correspondante.','p_police.jpg','b_gun','b_lens',1),
    ('Cimetière','','','p_graveyard.jpg','b_lens','b_pentagram',0),
    ('Caverne Noire','','','p_cavern.jpg','b_gun','b_book',0),
    ('Magasin','Achat','Au lieu de faire une rencontre ici, vous pouvez piocher 3 Objets Communs et en acheter un à son prix normal. Défaussez les deux autres objets.','p_shop.jpg','b_dollar','w_gun',1),
    ('La Maison de la Sorcière','','','p_witchHouse.jpg','b_lens','b_book',0),
    ('Loge Du Crepuscule d''Argent','Coeur de la Loge','Si vous êtes Membre du Crépuscule d''Argent, vous regardez alors la notice du Coeur de la Loge quand vous faites une rencontre ici.','p_loge.jpg','b_pentagram','b_lens',0),
    ('Pension de Ma','Recruter','Au lieu de faire une rencontre ici, vous pouvez dépenser des trophées de monstres pour un total de 10 en force, 2 trophées de portaiul, ou des trophées de monstres pour un total de 5 en force et 1 trophée de portail pour prendre l''Allié de votre choix dans le paquet Allié','p_pension.jpg','w_profil','b_heart',1),
    ('Église Méridionale','Bénédiction','Au lieu de faire une rencontre ici, vous pouvez dépenser des trophées de monstres pour un total de 5 en force ou 1 trophée de portail pour que l''investigateur de votre choix devienne Béni.','p_church.jpg','w_star','b_brain',1),
    ('Société des Historiens','','','p_historian.jpg','b_scroll','b_book',0),
    ('Bois','','','p_hood.jpg','b_dollar','b_gun',0),
    ('La vieille Échoppe de Magie','Cours de Magie','Au lieu de faire une rencontre ici, vous pouvez payer 5$ pour piocher 2 sorts. Gardez-en un et défaussez l''autre','p_magicShop.jpg','w_book','b_pentagram',1),
    ('Hôpital Sainte Marie','Soins Médicaux','Au lieu de faire une rencontre ici, vous pouvez récupérer de la Résistance en recevant des soins médicaux. Vous pouvez récupérer 1 Résistance gratuitement ou payer 2$ pour restaurer votre résistance au maximum.','p_hospital.jpg','b_lens','w_heart',1),
    ('Bibliothèque','','','p_library.jpg','b_pentagram','b_book',1),
    ('Administration','Cours','Au lieu de faire une rencontre ici, vous pouvez payer 8$ pour piocher 2 Compétences. Gardez-en une et défaussez l''autre.','p_administration.jpg','b_dollar','w_scroll',1),
    ('Département Scientifique','Dissection','Au lieu de faire une rencontre ici, vous pouvez dépenser des trophées de monstres pour un total de 5 en force ou 1 trophée de portail pour gagner 2 pions indice','p_scienceLab.jpg','w_lens','b_pentagram',0),
    ('L''Innomable','','','p_unspeakable.jpg','b_pentagram','b_lens',0),
    ('Les Quais','Personnage Louche','Au lieu de faire une rencontre ici, vous pouvez dépenser des trophées de monstres pour un total de 5 en force ou 1 trophée de portail pour gagner 5$.','p_dock.jpg','w_dollar','b_gun',1),
    ('Ile Inexplorée','','','p_island.jpg','b_lens','b_book',0);

INSERT INTO HaADistrictColor (`DC_name`) VALUES
    ('blue'),
    ('brown'),
    ('green'),
    ('grey'),
    ('orange'),
    ('red'),
    ('violet'),
    ('white'),
    ('yellow');
    
INSERT INTO HaADistrict (`D_name`,`D_color`,`D_place_1`,`D_place_2`,`D_place_3`) VALUES
    ('Quartier Nord','orange',1,2,3),
    ('Centre-Ville','white',4,5,6),
    ('Quartier Est','grey',7,8,9),
    ('Quartier De La Rivière','violet',10,11,12),
    ('French Hill','blue',13,14,null),
    ('Quartier Sud','brown',15,16,17),
    ('Quartier Résidentiel','red',18,19,20),
    ('Université Miskatonic','yellow',21,22,23),
    ('Quartier Marchand','green',24,25,26);

INSERT INTO HaADistrictLinkColor (`DLC_name`) VALUES
    ('white'), 
    ('black'),
    ('none');

INSERT INTO HaADistrictLink (`DL_district_1`,`DL_district_2`,`DL_color_1_2`,`DL_color_2_1`) VALUES
    (1,2,'white','black'),
    (1,9,'black','white'),
    (2,3,'white','black'),
    (2,9,'none','none'),
    (3,4,'white','black'),
    (4,9,'none','none'),
    (5,6,'white','black'),
    (5,8,'none','none'),
    (6,7,'white','black'),
    (7,8,'white','black'),
    (8,9,'white','black');
  
  
-- renommer les valeurs de TS_function lorsque la fonction existera    
INSERT INTO HaATerrorScale (`TS_id`,`TS_color`,`TS_function`) VALUES
    (0,null,null),
    (1,null,null),
    (2,null,null),
    (3,'127000255','TS_violet'),
    (4,null,null),
    (5,null,null),
    (6,'255153051','TS_orange'),
    (7,null,null),
    (8,null,null),
    (9,'255000000','TS_red'),
    (10,'160160160','TS_grey');
    
INSERT INTO HaACityLimits (`CL_name`,`CL_image`) VALUES
    ('Périphérie','cl_periphery.jpg'),
    ('Ciel','cl_sky.jpg'),
    ('Perdu dans le temps et l''espace','cl_lost.jpg');
    
