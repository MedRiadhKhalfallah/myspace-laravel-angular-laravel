<?php

namespace Database\Seeders;

use App\Models\Delegation;
use Illuminate\Database\Seeder;

class DelegationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        ariana
        Delegation::create(['id' => '1', 'nom' => 'Ariana Ville', 'gouvernorat_id' => '1']);
        Delegation::create(['id' => '2', 'nom' => 'Ettadhamen', 'gouvernorat_id' => '1']);
        Delegation::create(['id' => '3', 'nom' => 'Kalaat Landlous', 'gouvernorat_id' => '1']);
        Delegation::create(['id' => '4', 'nom' => 'La Soukra', 'gouvernorat_id' => '1']);
        Delegation::create(['id' => '5', 'nom' => 'Mnihla', 'gouvernorat_id' => '1']);
        Delegation::create(['id' => '6', 'nom' => 'Raoued', 'gouvernorat_id' => '1']);
        Delegation::create(['id' => '7', 'nom' => 'Sidi Thabet', 'gouvernorat_id' => '1']);
//Beja
        Delegation::create(['id' => '8', 'nom' => 'Amdoun', 'gouvernorat_id' => '2']);
        Delegation::create(['id' => '9', 'nom' => 'Beja Nord', 'gouvernorat_id' => '2']);
        Delegation::create(['id' => '10', 'nom' => 'Beja Sud', 'gouvernorat_id' => '2']);
        Delegation::create(['id' => '11', 'nom' => 'Goubellat', 'gouvernorat_id' => '2']);
        Delegation::create(['id' => '12', 'nom' => 'Mejez El Bab', 'gouvernorat_id' => '2']);
        Delegation::create(['id' => '13', 'nom' => 'Nefza', 'gouvernorat_id' => '2']);
        Delegation::create(['id' => '14', 'nom' => 'Teboursouk', 'gouvernorat_id' => '2']);
        Delegation::create(['id' => '15', 'nom' => 'Testour', 'gouvernorat_id' => '2']);
        Delegation::create(['id' => '16', 'nom' => 'Thibar', 'gouvernorat_id' => '2']);
//        Ben arous
        Delegation::create(['id' => '17', 'nom' => 'Ben Arous', 'gouvernorat_id' => '3']);
        Delegation::create(['id' => '18', 'nom' => 'Bou Mhel El Bassatine', 'gouvernorat_id' => '3']);
        Delegation::create(['id' => '19', 'nom' => 'El Mourouj', 'gouvernorat_id' => '3']);
        Delegation::create(['id' => '20', 'nom' => 'Ezzahra', 'gouvernorat_id' => '3']);
        Delegation::create(['id' => '21', 'nom' => 'Fouchana', 'gouvernorat_id' => '3']);
        Delegation::create(['id' => '22', 'nom' => 'Hammam Chatt', 'gouvernorat_id' => '3']);
        Delegation::create(['id' => '23', 'nom' => 'Hammam Lif', 'gouvernorat_id' => '3']);
        Delegation::create(['id' => '24', 'nom' => 'Megrine', 'gouvernorat_id' => '3']);
        Delegation::create(['id' => '25', 'nom' => 'Mohamadia', 'gouvernorat_id' => '3']);
        Delegation::create(['id' => '26', 'nom' => 'Mornag', 'gouvernorat_id' => '3']);
        Delegation::create(['id' => '27', 'nom' => 'Nouvelle Medina', 'gouvernorat_id' => '3']);
        Delegation::create(['id' => '28', 'nom' => 'Rades', 'gouvernorat_id' => '3']);
//        Bizerte
        Delegation::create(['id' => '29', 'nom' => 'Bizerte Nord', 'gouvernorat_id' => '4']);
        Delegation::create(['id' => '30', 'nom' => 'Bizerte Sud', 'gouvernorat_id' => '4']);
        Delegation::create(['id' => '31', 'nom' => 'El Alia', 'gouvernorat_id' => '4']);
        Delegation::create(['id' => '32', 'nom' => 'Ghar El Melh', 'gouvernorat_id' => '4']);
        Delegation::create(['id' => '33', 'nom' => 'Ghezala', 'gouvernorat_id' => '4']);
        Delegation::create(['id' => '34', 'nom' => 'Jarzouna', 'gouvernorat_id' => '4']);
        Delegation::create(['id' => '35', 'nom' => 'Joumine', 'gouvernorat_id' => '4']);
        Delegation::create(['id' => '36', 'nom' => 'Mateur', 'gouvernorat_id' => '4']);
        Delegation::create(['id' => '37', 'nom' => 'Menzel Bourguiba', 'gouvernorat_id' => '4']);
        Delegation::create(['id' => '38', 'nom' => 'Menzel Jemil', 'gouvernorat_id' => '4']);
        Delegation::create(['id' => '39', 'nom' => 'Ras Jebel', 'gouvernorat_id' => '4']);
        Delegation::create(['id' => '40', 'nom' => 'Sejnane', 'gouvernorat_id' => '4']);
        Delegation::create(['id' => '41', 'nom' => 'Tinja', 'gouvernorat_id' => '4']);
        Delegation::create(['id' => '42', 'nom' => 'Utique', 'gouvernorat_id' => '4']);
//        Gabes
        Delegation::create(['id' => '43', 'nom' => 'El Hamma', 'gouvernorat_id' => '5']);
        Delegation::create(['id' => '44', 'nom' => 'El Metouia', 'gouvernorat_id' => '5']);
        Delegation::create(['id' => '45', 'nom' => 'Gabes Medina	', 'gouvernorat_id' => '5']);
        Delegation::create(['id' => '46', 'nom' => 'Gabes Ouest	', 'gouvernorat_id' => '5']);
        Delegation::create(['id' => '47', 'nom' => 'Gabes Sud', 'gouvernorat_id' => '5']);
        Delegation::create(['id' => '48', 'nom' => 'Ghannouche', 'gouvernorat_id' => '5']);
        Delegation::create(['id' => '49', 'nom' => 'Mareth', 'gouvernorat_id' => '5']);
        Delegation::create(['id' => '50', 'nom' => 'Matmata', 'gouvernorat_id' => '5']);
        Delegation::create(['id' => '51', 'nom' => 'Menzel Habib	', 'gouvernorat_id' => '5']);
        Delegation::create(['id' => '52', 'nom' => 'Nouvelle Matmata', 'gouvernorat_id' => '5']);
//        Gafsa
        Delegation::create(['id' => '53', 'nom' => 'Belkhir', 'gouvernorat_id' => '6']);
        Delegation::create(['id' => '54', 'nom' => 'El Guettar', 'gouvernorat_id' => '6']);
        Delegation::create(['id' => '55', 'nom' => 'El Ksar', 'gouvernorat_id' => '6']);
        Delegation::create(['id' => '56', 'nom' => 'El Mdhilla', 'gouvernorat_id' => '6']);
        Delegation::create(['id' => '57', 'nom' => 'Gafsa Nord', 'gouvernorat_id' => '6']);
        Delegation::create(['id' => '58', 'nom' => 'Gafsa Sud', 'gouvernorat_id' => '6']);
        Delegation::create(['id' => '59', 'nom' => 'Metlaoui', 'gouvernorat_id' => '6']);
        Delegation::create(['id' => '60', 'nom' => 'Moulares', 'gouvernorat_id' => '6']);
        Delegation::create(['id' => '61', 'nom' => 'Redeyef', 'gouvernorat_id' => '6']);
        Delegation::create(['id' => '62', 'nom' => 'Sidi Aich', 'gouvernorat_id' => '6']);
        Delegation::create(['id' => '63', 'nom' => 'Sned', 'gouvernorat_id' => '6']);
//        Jendouba
        Delegation::create(['id' => '64', 'nom' => 'Ain Draham', 'gouvernorat_id' => '7']);
        Delegation::create(['id' => '65', 'nom' => 'Balta Bou Aouene', 'gouvernorat_id' => '7']);
        Delegation::create(['id' => '66', 'nom' => 'Bou Salem', 'gouvernorat_id' => '7']);
        Delegation::create(['id' => '67', 'nom' => 'Fernana', 'gouvernorat_id' => '7']);
        Delegation::create(['id' => '68', 'nom' => 'Ghardimaou', 'gouvernorat_id' => '7']);
        Delegation::create(['id' => '69', 'nom' => 'Jendouba', 'gouvernorat_id' => '7']);
        Delegation::create(['id' => '70', 'nom' => 'Jendouba Nord', 'gouvernorat_id' => '7']);
        Delegation::create(['id' => '71', 'nom' => 'Oued Mliz', 'gouvernorat_id' => '7']);
        Delegation::create(['id' => '72', 'nom' => 'Tabarka', 'gouvernorat_id' => '7']);
//        Kairouan
        Delegation::create(['id' => '73', 'nom' => 'Bou Hajla', 'gouvernorat_id' => '8']);
        Delegation::create(['id' => '74', 'nom' => 'Chebika', 'gouvernorat_id' => '8']);
        Delegation::create(['id' => '75', 'nom' => 'Cherarda', 'gouvernorat_id' => '8']);
        Delegation::create(['id' => '76', 'nom' => 'El Ala', 'gouvernorat_id' => '8']);
        Delegation::create(['id' => '77', 'nom' => 'Haffouz', 'gouvernorat_id' => '8']);
        Delegation::create(['id' => '78', 'nom' => 'Hajeb El Ayoun', 'gouvernorat_id' => '8']);
        Delegation::create(['id' => '79', 'nom' => 'Kairouan Nord', 'gouvernorat_id' => '8']);
        Delegation::create(['id' => '80', 'nom' => 'Kairouan Sud', 'gouvernorat_id' => '8']);
        Delegation::create(['id' => '81', 'nom' => 'Nasrallah', 'gouvernorat_id' => '8']);
        Delegation::create(['id' => '82', 'nom' => 'Oueslatia', 'gouvernorat_id' => '8']);
        Delegation::create(['id' => '83', 'nom' => 'Sbikha', 'gouvernorat_id' => '8']);
//        Kasserine
        Delegation::create(['id' => '84', 'nom' => 'El Ayoun', 'gouvernorat_id' => '9']);
        Delegation::create(['id' => '85', 'nom' => 'Ezzouhour (Kasserine)', 'gouvernorat_id' => '9']);
        Delegation::create(['id' => '86', 'nom' => 'Feriana', 'gouvernorat_id' => '9']);
        Delegation::create(['id' => '87', 'nom' => 'Foussana', 'gouvernorat_id' => '9']);
        Delegation::create(['id' => '88', 'nom' => 'Haidra', 'gouvernorat_id' => '9']);
        Delegation::create(['id' => '89', 'nom' => 'Hassi El Frid', 'gouvernorat_id' => '9']);
        Delegation::create(['id' => '90', 'nom' => 'Jediliane', 'gouvernorat_id' => '9']);
        Delegation::create(['id' => '91', 'nom' => 'Kasserine Nord', 'gouvernorat_id' => '9']);
        Delegation::create(['id' => '92', 'nom' => 'Kasserine Sud', 'gouvernorat_id' => '9']);
        Delegation::create(['id' => '93', 'nom' => 'Mejel Bel Abbes', 'gouvernorat_id' => '9']);
        Delegation::create(['id' => '94', 'nom' => 'Sbeitla', 'gouvernorat_id' => '9']);
        Delegation::create(['id' => '95', 'nom' => 'Sbiba', 'gouvernorat_id' => '9']);
        Delegation::create(['id' => '96', 'nom' => 'Thala', 'gouvernorat_id' => '9']);
//        Kebili
        Delegation::create(['id' => '97', 'nom' => 'Douz', 'gouvernorat_id' => '10']);
        Delegation::create(['id' => '98', 'nom' => 'El Faouar', 'gouvernorat_id' => '10']);
        Delegation::create(['id' => '99', 'nom' => 'Kebili Nord', 'gouvernorat_id' => '10']);
        Delegation::create(['id' => '101', 'nom' => 'Kebili Sud', 'gouvernorat_id' => '10']);
        Delegation::create(['id' => '102', 'nom' => 'Souk El Ahad', 'gouvernorat_id' => '10']);
//        Le Kef
        Delegation::create(['id' => '103', 'nom' => 'Dahmani', 'gouvernorat_id' => '11']);
        Delegation::create(['id' => '104', 'nom' => 'El Ksour', 'gouvernorat_id' => '11']);
        Delegation::create(['id' => '105', 'nom' => 'Jerissa', 'gouvernorat_id' => '11']);
        Delegation::create(['id' => '106', 'nom' => 'Kalaa El Khasba', 'gouvernorat_id' => '11']);
        Delegation::create(['id' => '107', 'nom' => 'Kalaat Sinane', 'gouvernorat_id' => '11']);
        Delegation::create(['id' => '108', 'nom' => 'Le Kef Est', 'gouvernorat_id' => '11']);
        Delegation::create(['id' => '109', 'nom' => 'Le Kef Ouest', 'gouvernorat_id' => '11']);
        Delegation::create(['id' => '110', 'nom' => 'Le Sers', 'gouvernorat_id' => '11']);
        Delegation::create(['id' => '111', 'nom' => 'Nebeur', 'gouvernorat_id' => '11']);
        Delegation::create(['id' => '112', 'nom' => 'Sakiet Sidi Youssef', 'gouvernorat_id' => '11']);
        Delegation::create(['id' => '113', 'nom' => 'Tajerouine', 'gouvernorat_id' => '11']);
        Delegation::create(['id' => '114', 'nom' => 'Touiref', 'gouvernorat_id' => '11']);
//        Mahdia
        Delegation::create(['id' => '115', 'nom' => 'Bou Merdes', 'gouvernorat_id' => '12']);
        Delegation::create(['id' => '116', 'nom' => 'Chorbane', 'gouvernorat_id' => '12']);
        Delegation::create(['id' => '117', 'nom' => 'El Jem', 'gouvernorat_id' => '12']);
        Delegation::create(['id' => '118', 'nom' => 'Hbira', 'gouvernorat_id' => '12']);
        Delegation::create(['id' => '119', 'nom' => 'Ksour Essaf', 'gouvernorat_id' => '12']);
        Delegation::create(['id' => '120', 'nom' => 'La Chebba', 'gouvernorat_id' => '12']);
        Delegation::create(['id' => '121', 'nom' => 'Mahdia', 'gouvernorat_id' => '12']);
        Delegation::create(['id' => '122', 'nom' => 'Melloulech', 'gouvernorat_id' => '12']);
        Delegation::create(['id' => '123', 'nom' => 'Ouled Chamakh', 'gouvernorat_id' => '12']);
        Delegation::create(['id' => '124', 'nom' => 'Sidi Alouene', 'gouvernorat_id' => '12']);
        Delegation::create(['id' => '125', 'nom' => 'Souassi', 'gouvernorat_id' => '12']);
//        Manouba
        Delegation::create(['id' => '126', 'nom' => 'Borj El Amri', 'gouvernorat_id' => '13']);
        Delegation::create(['id' => '127', 'nom' => 'Douar Hicher', 'gouvernorat_id' => '13']);
        Delegation::create(['id' => '128', 'nom' => 'El Battan', 'gouvernorat_id' => '13']);
        Delegation::create(['id' => '129', 'nom' => 'Jedaida', 'gouvernorat_id' => '13']);
        Delegation::create(['id' => '130', 'nom' => 'Mannouba', 'gouvernorat_id' => '13']);
        Delegation::create(['id' => '131', 'nom' => 'Mornaguia', 'gouvernorat_id' => '13']);
        Delegation::create(['id' => '132', 'nom' => 'Oued Ellil', 'gouvernorat_id' => '13']);
        Delegation::create(['id' => '133', 'nom' => 'Tebourba', 'gouvernorat_id' => '13']);
//        Medenine
        Delegation::create(['id' => '134', 'nom' => 'Ajim', 'gouvernorat_id' => '14']);
        Delegation::create(['id' => '135', 'nom' => 'Ben Guerdane', 'gouvernorat_id' => '14']);
        Delegation::create(['id' => '136', 'nom' => 'Beni Khedache', 'gouvernorat_id' => '14']);
        Delegation::create(['id' => '137', 'nom' => 'Djerba - Houmet Essouk', 'gouvernorat_id' => '14']);
        Delegation::create(['id' => '138', 'nom' => 'Djerba - Midoun', 'gouvernorat_id' => '14']);
        Delegation::create(['id' => '139', 'nom' => 'Medenine Nord', 'gouvernorat_id' => '14']);
        Delegation::create(['id' => '140', 'nom' => 'Medenine Sud', 'gouvernorat_id' => '14']);
        Delegation::create(['id' => '141', 'nom' => 'Sidi Makhlouf', 'gouvernorat_id' => '14']);
        Delegation::create(['id' => '142', 'nom' => 'Zarzis', 'gouvernorat_id' => '14']);
//        Monastir
        Delegation::create(['id' => '143', 'nom' => 'Bekalta', 'gouvernorat_id' => '15']);
        Delegation::create(['id' => '144', 'nom' => 'Bembla', 'gouvernorat_id' => '15']);
        Delegation::create(['id' => '145', 'nom' => 'Beni Hassen', 'gouvernorat_id' => '15']);
        Delegation::create(['id' => '146', 'nom' => 'Jemmal', 'gouvernorat_id' => '15']);
        Delegation::create(['id' => '147', 'nom' => 'Ksar Helal', 'gouvernorat_id' => '15']);
        Delegation::create(['id' => '148', 'nom' => 'Ksibet El Mediouni', 'gouvernorat_id' => '15']);
        Delegation::create(['id' => '149', 'nom' => 'Moknine', 'gouvernorat_id' => '15']);
        Delegation::create(['id' => '150', 'nom' => 'Monastir', 'gouvernorat_id' => '15']);
        Delegation::create(['id' => '151', 'nom' => 'Ouerdanine', 'gouvernorat_id' => '15']);
        Delegation::create(['id' => '152', 'nom' => 'Sahline', 'gouvernorat_id' => '15']);
        Delegation::create(['id' => '153', 'nom' => 'Sayada Lamta Bou Hajar', 'gouvernorat_id' => '15']);
        Delegation::create(['id' => '154', 'nom' => 'Teboulba', 'gouvernorat_id' => '15']);
        Delegation::create(['id' => '155', 'nom' => 'Zeramdine', 'gouvernorat_id' => '15']);
//        Nabeul
        Delegation::create(['id' => '156', 'nom' => 'Beni Khalled', 'gouvernorat_id' => '16']);
        Delegation::create(['id' => '157', 'nom' => 'Beni Khiar', 'gouvernorat_id' => '16']);
        Delegation::create(['id' => '158', 'nom' => 'Bou Argoub', 'gouvernorat_id' => '16']);
        Delegation::create(['id' => '159', 'nom' => 'Dar Chaabane Elfehri', 'gouvernorat_id' => '16']);
        Delegation::create(['id' => '160', 'nom' => 'El Haouaria', 'gouvernorat_id' => '16']);
        Delegation::create(['id' => '161', 'nom' => 'El Mida', 'gouvernorat_id' => '16']);
        Delegation::create(['id' => '162', 'nom' => 'Grombalia', 'gouvernorat_id' => '16']);
        Delegation::create(['id' => '163', 'nom' => 'Hammam El Ghezaz', 'gouvernorat_id' => '16']);
        Delegation::create(['id' => '164', 'nom' => 'Hammamet', 'gouvernorat_id' => '16']);
        Delegation::create(['id' => '165', 'nom' => 'Kelibia', 'gouvernorat_id' => '16']);
        Delegation::create(['id' => '166', 'nom' => 'Korba', 'gouvernorat_id' => '16']);
        Delegation::create(['id' => '167', 'nom' => 'Menzel Bouzelfa', 'gouvernorat_id' => '16']);
        Delegation::create(['id' => '168', 'nom' => 'Menzel Temime', 'gouvernorat_id' => '16']);
        Delegation::create(['id' => '169', 'nom' => 'Nabeul', 'gouvernorat_id' => '16']);
        Delegation::create(['id' => '170', 'nom' => 'Soliman', 'gouvernorat_id' => '16']);
        Delegation::create(['id' => '171', 'nom' => 'Takelsa', 'gouvernorat_id' => '16']);
//        Sfax
        Delegation::create(['id' => '172', 'nom' => 'Agareb', 'gouvernorat_id' => '17']);
        Delegation::create(['id' => '173', 'nom' => 'Bir Ali Ben Khelifa', 'gouvernorat_id' => '17']);
        Delegation::create(['id' => '174', 'nom' => 'El Amra', 'gouvernorat_id' => '17']);
        Delegation::create(['id' => '175', 'nom' => 'El Hencha', 'gouvernorat_id' => '17']);
        Delegation::create(['id' => '176', 'nom' => 'Esskhira', 'gouvernorat_id' => '17']);
        Delegation::create(['id' => '177', 'nom' => 'Ghraiba', 'gouvernorat_id' => '17']);
        Delegation::create(['id' => '178', 'nom' => 'Jebeniana', 'gouvernorat_id' => '17']);
        Delegation::create(['id' => '179', 'nom' => 'Kerkenah', 'gouvernorat_id' => '17']);
        Delegation::create(['id' => '180', 'nom' => 'Mahras', 'gouvernorat_id' => '17']);
        Delegation::create(['id' => '181', 'nom' => 'Menzel Chaker', 'gouvernorat_id' => '17']);
        Delegation::create(['id' => '182', 'nom' => 'Sakiet Eddaier', 'gouvernorat_id' => '17']);
        Delegation::create(['id' => '183', 'nom' => 'Sakiet Ezzit', 'gouvernorat_id' => '17']);
        Delegation::create(['id' => '184', 'nom' => 'Sfax Est', 'gouvernorat_id' => '17']);
        Delegation::create(['id' => '185', 'nom' => 'Sfax Sud', 'gouvernorat_id' => '17']);
        Delegation::create(['id' => '186', 'nom' => 'Sfax Ville', 'gouvernorat_id' => '17']);
//        Sidi bouzid
        Delegation::create(['id' => '187', 'nom' => 'Ben Oun', 'gouvernorat_id' => '18']);
        Delegation::create(['id' => '188', 'nom' => 'Bir El Haffey', 'gouvernorat_id' => '18']);
        Delegation::create(['id' => '189', 'nom' => 'Cebbala', 'gouvernorat_id' => '18']);
        Delegation::create(['id' => '190', 'nom' => 'Jilma', 'gouvernorat_id' => '18']);
        Delegation::create(['id' => '191', 'nom' => 'Maknassy', 'gouvernorat_id' => '18']);
        Delegation::create(['id' => '192', 'nom' => 'Menzel Bouzaiene', 'gouvernorat_id' => '18']);
        Delegation::create(['id' => '193', 'nom' => 'Mezzouna', 'gouvernorat_id' => '18']);
        Delegation::create(['id' => '194', 'nom' => 'Ouled Haffouz', 'gouvernorat_id' => '18']);
        Delegation::create(['id' => '195', 'nom' => 'Regueb', 'gouvernorat_id' => '18']);
        Delegation::create(['id' => '196', 'nom' => 'Sidi Bouzid Est', 'gouvernorat_id' => '18']);
        Delegation::create(['id' => '197', 'nom' => 'Sidi Bouzid Ouest', 'gouvernorat_id' => '18']);
        Delegation::create(['id' => '198', 'nom' => 'Souk Jedid', 'gouvernorat_id' => '18']);
//        Siliana
        Delegation::create(['id' => '199', 'nom' => 'Bargou', 'gouvernorat_id' => '19']);
        Delegation::create(['id' => '200', 'nom' => 'Bou Arada', 'gouvernorat_id' => '19']);
        Delegation::create(['id' => '201', 'nom' => 'El Aroussa', 'gouvernorat_id' => '19']);
        Delegation::create(['id' => '202', 'nom' => 'Gaafour', 'gouvernorat_id' => '19']);
        Delegation::create(['id' => '203', 'nom' => 'Kesra', 'gouvernorat_id' => '19']);
        Delegation::create(['id' => '204', 'nom' => 'Le Krib', 'gouvernorat_id' => '19']);
        Delegation::create(['id' => '205', 'nom' => 'Makthar', 'gouvernorat_id' => '19']);
        Delegation::create(['id' => '206', 'nom' => 'Rohia', 'gouvernorat_id' => '19']);
        Delegation::create(['id' => '207', 'nom' => 'Sidi Bou Rouis', 'gouvernorat_id' => '19']);
        Delegation::create(['id' => '208', 'nom' => 'Siliana Nord', 'gouvernorat_id' => '19']);
        Delegation::create(['id' => '209', 'nom' => 'Siliana Sud', 'gouvernorat_id' => '19']);
//        Sousse
        Delegation::create(['id' => '210', 'nom' => 'Akouda', 'gouvernorat_id' => '20']);
        Delegation::create(['id' => '211', 'nom' => 'Bou Ficha', 'gouvernorat_id' => '20']);
        Delegation::create(['id' => '212', 'nom' => 'Enfidha', 'gouvernorat_id' => '20']);
        Delegation::create(['id' => '213', 'nom' => 'Hammam Sousse', 'gouvernorat_id' => '20']);
        Delegation::create(['id' => '214', 'nom' => 'Hergla', 'gouvernorat_id' => '20']);
        Delegation::create(['id' => '215', 'nom' => 'Kalaa El Kebira', 'gouvernorat_id' => '20']);
        Delegation::create(['id' => '216', 'nom' => 'Kalaa Essghira', 'gouvernorat_id' => '20']);
        Delegation::create(['id' => '217', 'nom' => 'Kondar', 'gouvernorat_id' => '20']);
        Delegation::create(['id' => '218', 'nom' => 'Msaken', 'gouvernorat_id' => '20']);
        Delegation::create(['id' => '219', 'nom' => 'Sidi Bou Ali', 'gouvernorat_id' => '20']);
        Delegation::create(['id' => '220', 'nom' => 'Sidi El Heni', 'gouvernorat_id' => '20']);
        Delegation::create(['id' => '221', 'nom' => 'Sousse Jaouhara', 'gouvernorat_id' => '20']);
        Delegation::create(['id' => '222', 'nom' => 'Sousse Riadh', 'gouvernorat_id' => '20']);
        Delegation::create(['id' => '223', 'nom' => 'Sousse Ville', 'gouvernorat_id' => '20']);
//        Tataouine
        Delegation::create(['id' => '224', 'nom' => 'Bir Lahmar', 'gouvernorat_id' => '21']);
        Delegation::create(['id' => '225', 'nom' => 'Dhehiba', 'gouvernorat_id' => '21']);
        Delegation::create(['id' => '226', 'nom' => 'Ghomrassen', 'gouvernorat_id' => '21']);
        Delegation::create(['id' => '227', 'nom' => 'Remada', 'gouvernorat_id' => '21']);
        Delegation::create(['id' => '228', 'nom' => 'Smar', 'gouvernorat_id' => '21']);
        Delegation::create(['id' => '229', 'nom' => 'Tataouine Nord', 'gouvernorat_id' => '21']);
        Delegation::create(['id' => '230', 'nom' => 'Tataouine Sud', 'gouvernorat_id' => '21']);
//        Tozeur
        Delegation::create(['id' => '231', 'nom' => 'Degueche', 'gouvernorat_id' => '22']);
        Delegation::create(['id' => '232', 'nom' => 'Hezoua', 'gouvernorat_id' => '22']);
        Delegation::create(['id' => '234', 'nom' => 'Nefta', 'gouvernorat_id' => '22']);
        Delegation::create(['id' => '235', 'nom' => 'Tameghza', 'gouvernorat_id' => '22']);
        Delegation::create(['id' => '236', 'nom' => 'Tozeur', 'gouvernorat_id' => '22']);
//			 Tunis
        Delegation::create(['id' => '237', 'nom' => 'Ain Zaghouan', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '238', 'nom' => 'Bab Bhar', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '239', 'nom' => 'Bab Souika', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '240', 'nom' => 'Carthage', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '241', 'nom' => 'Cite El Khadra', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '242', 'nom' => 'El Hrairia', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '243', 'nom' => 'El Kabbaria', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '244', 'nom' => 'El Kram', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '245', 'nom' => 'El Menzah', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '246', 'nom' => 'El Omrane', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '247', 'nom' => 'El Omrane Superieur', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '248', 'nom' => 'El Ouerdia', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '249', 'nom' => 'Essijoumi', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '250', 'nom' => 'Ettahrir', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '251', 'nom' => 'Ezzouhour (Tunis)', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '252', 'nom' => 'Jebel Jelloud', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '253', 'nom' => 'La Goulette', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '254', 'nom' => 'La Marsa', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '255', 'nom' => 'La Medina', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '256', 'nom' => 'Le Bardo', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '257', 'nom' => 'Sidi El Bechir', 'gouvernorat_id' => '23']);
        Delegation::create(['id' => '258', 'nom' => 'Sidi Hassine', 'gouvernorat_id' => '23']);
//        Zaghouan
        Delegation::create(['id' => '259', 'nom' => 'Bir Mcherga', 'gouvernorat_id' => '24']);
        Delegation::create(['id' => '260', 'nom' => 'El Fahs', 'gouvernorat_id' => '24']);
        Delegation::create(['id' => '261', 'nom' => 'Ennadhour', 'gouvernorat_id' => '24']);
        Delegation::create(['id' => '262', 'nom' => 'Hammam Zriba', 'gouvernorat_id' => '24']);
        Delegation::create(['id' => '263', 'nom' => 'Saouef', 'gouvernorat_id' => '24']);
        Delegation::create(['id' => '264', 'nom' => 'Zaghouan', 'gouvernorat_id' => '24']);
    }
}
