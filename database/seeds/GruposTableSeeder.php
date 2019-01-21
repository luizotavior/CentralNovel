<?php

use Illuminate\Database\Seeder;

class GruposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $grupos = array(
            array('id' => '1','nome' => 'Kuork','site' => 'http://www.kuork.org/','feed' => 'http://www.kuork.org/feed/','email' => 'kuork@kuork.org','url' => 'kuork','status' => '1','clicks' => '41991','data_nasc' => '2016-10-04 20:22:27','data_last' => '2016-10-07 11:00:09'),
            array('id' => '5','nome' => 'Novel Mania','site' => 'http://novelmania.com.br/','feed' => 'http://novelmania.com.br/feed/','email' => 'contato@novelmania.com.br','url' => 'novel-mania','status' => '1','clicks' => '140824','data_nasc' => '2016-10-04 20:22:27','data_last' => '2016-10-04 22:12:49'),
            array('id' => '6','nome' => 'Kote Brasil','site' => 'https://kotebrasil.wordpress.com/','feed' => 'https://kotebrasil.wordpress.com/feed/','email' => 'kote-san@hotmail.com','url' => 'kote-brasil','status' => '1','clicks' => '4510','data_nasc' => '2016-10-04 20:22:27','data_last' => '2016-10-07 11:00:11'),
            array('id' => '7','nome' => 'SaikaiScan','site' => 'http://saikaiscan.com.br/','feed' => 'https://saikaiscan.com.br/feed/','email' => '','url' => 'saikai-scan','status' => '1','clicks' => '112291','data_nasc' => '2016-10-04 20:22:27','data_last' => '2016-10-07 11:00:08'),
            array('id' => '8','nome' => 'Miríades Alternativas','site' => 'https://miriadesalternativas.wordpress.com/','feed' => 'https://miriadesalternativas.wordpress.com/feed/','email' => '','url' => 'miriadesalternativas','status' => '1','clicks' => '5909','data_nasc' => '2016-10-04 20:22:27','data_last' => '2016-10-07 11:00:10'),
            array('id' => '9','nome' => 'Heroi Undead Novels','site' => 'https://heroiundeadnovels.wordpress.com/','feed' => 'https://heroiundeadnovels.wordpress.com/feed/','email' => 'heroiundead@gmail.com','url' => 'heroi-undead','status' => '1','clicks' => '3870','data_nasc' => '2016-10-07 21:00:00','data_last' => '2016-10-07 23:33:14'),
            array('id' => '10','nome' => 'MonsTranslator','site' => 'https://monstranslator.wordpress.com/','feed' => 'https://monstranslator.wordpress.com/feed/','email' => '','url' => 'monstranslator','status' => '1','clicks' => '1698','data_nasc' => '2016-10-07 20:00:00','data_last' => '2016-10-07 23:34:34'),
            array('id' => '12','nome' => 'Seed','site' => 'https://seedwordpress.wordpress.com/','feed' => 'https://seedwordpress.wordpress.com/feed/','email' => 'SilverSeed003@hotmail.com','url' => 'seed','status' => '1','clicks' => '1969','data_nasc' => '2016-10-08 00:56:26','data_last' => '2016-10-08 00:56:26'),
            array('id' => '13','nome' => 'Reiki Project','site' => 'http://reikiproject.blogspot.com.br/','feed' => 'http://reikiproject.blogspot.com.br/feeds/posts/default','email' => 'guido.himitsunogenko@gmail.com','url' => 'reikipriject','status' => '1','clicks' => '182','data_nasc' => '2016-10-08 03:04:07','data_last' => '2016-10-08 03:04:07'),
            array('id' => '14','nome' => 'SAO - Light Novel','site' => 'https://saolightnovel.wordpress.com/','feed' => 'https://saolightnovel.wordpress.com/feed/','email' => '','url' => 'saoln','status' => '1','clicks' => '902','data_nasc' => '2016-10-08 03:04:51','data_last' => '2016-10-08 03:04:51'),
            array('id' => '15','nome' => 'Thyros Traduções','site' => 'https://thyros.wordpress.com/','feed' => 'https://thyros.wordpress.com/feed/','email' => 'thyrostraducoes@gmail.com','url' => 'thyros-traducoes','status' => '1','clicks' => '4118','data_nasc' => '2016-10-08 03:05:35','data_last' => '2016-10-08 03:05:35'),
            array('id' => '16','nome' => 'BatataTD','site' => 'https://batatatd.wordpress.com/','feed' => 'https://batatatd.wordpress.com/feed/','email' => '','url' => 'batatatd','status' => '1','clicks' => '1166','data_nasc' => '2016-10-08 03:05:49','data_last' => '2016-10-08 03:05:49'),
            array('id' => '23','nome' => 'TDG Traduções','site' => 'http://talesofdemonsandgods.com.br/','feed' => 'http://talesofdemonsandgods.com.br/feed/','email' => '','url' => 'tdg-traducoes','status' => '0','clicks' => '344','data_nasc' => '2016-10-08 22:27:31','data_last' => '2016-10-08 22:27:31'),
            array('id' => '24','nome' => 'Vulks Novels','site' => 'https://vulksnovels.wordpress.com/','feed' => 'https://vulksnovels.wordpress.com/feed','email' => 'vulksnovels@hotmail.com','url' => 'vulks-novels','status' => '1','clicks' => '3451','data_nasc' => '2016-10-23 06:43:27','data_last' => '2016-10-23 06:43:27'),
            array('id' => '26','nome' => 'Shiraorismo HQ','site' => 'https://shiraorismhq.wordpress.com/','feed' => 'https://shiraorismhq.wordpress.com/feed/','email' => 'barekumabear@gmail.com','url' => 'shiraorismhq','status' => '1','clicks' => '363','data_nasc' => '2016-10-31 18:13:59','data_last' => '2016-10-31 18:13:59'),
            array('id' => '27','nome' => 'Cosmos Novels','site' => 'https://cosmosnovels.wordpress.com','feed' => 'https://cosmosnovels.wordpress.com/feed/','email' => 'cosmosnovels@hotmail.com','url' => 'cosmosnovels','status' => '1','clicks' => '559','data_nasc' => '2016-11-02 11:48:34','data_last' => '2016-11-02 11:48:34'),
            array('id' => '29','nome' => 'Novel Traduções','site' => 'https://noveltraducoes.wordpress.com/','feed' => 'https://noveltraducoes.wordpress.com/feed/','email' => 'nyel_nyedson@hotmail.com','url' => 'noveltraducoes','status' => '1','clicks' => '4066','data_nasc' => '2016-11-07 18:36:40','data_last' => '2016-11-07 18:36:40'),
            array('id' => '30','nome' => 'Empire Novels','site' => 'http://empirenovels.com.br/','feed' => 'http://empirenovels.com.br/feed/','email' => 'empirenovels@gmail.com','url' => 'empirenovels','status' => '1','clicks' => '31697','data_nasc' => '2016-11-10 12:18:44','data_last' => '2016-11-10 12:18:44'),
            array('id' => '31','nome' => 'Ciclone Livros','site' => 'https://ciclonelivros.wordpress.com/','feed' => 'https://ciclonelivros.wordpress.com/feed/','email' => 'ttimesna@gmail.com','url' => 'ciclonelivros','status' => '1','clicks' => '418','data_nasc' => '2016-11-13 00:25:10','data_last' => '2016-11-13 00:25:10'),
            array('id' => '33','nome' => 'Monktoom','site' => 'https://monktom.wordpress.com/','feed' => 'https://monktom.wordpress.com/feed/','email' => 'ttimesna@gmail.com','url' => 'monktom','status' => '1','clicks' => '444','data_nasc' => '2016-11-27 22:37:39','data_last' => '2016-11-27 22:37:39'),
            array('id' => '34','nome' => 'Asura Novel','site' => 'https://asuranovel.wordpress.com/','feed' => 'https://asuranovel.wordpress.com/feed/','email' => 'flux1606@gmail.com','url' => 'asuranovel','status' => '1','clicks' => '393','data_nasc' => '2016-12-07 17:35:20','data_last' => '2016-12-07 17:35:20'),
            array('id' => '35','nome' => 'Yuere Traduções','site' => 'https://dsptbr.wordpress.com','feed' => 'https://dsptbr.wordpress.com/feed/','email' => 'yueretl@gmail.com','url' => 'dsptbr','status' => '1','clicks' => '1361','data_nasc' => '2016-12-16 22:43:05','data_last' => '2016-12-16 22:43:05'),
            array('id' => '36','nome' => 'Casa Da Novel','site' => 'https://casadanovel.wordpress.com/','feed' => 'https://casadanovel.wordpress.com/feed/','email' => 'casadanovel@gmail.com','url' => 'casadanovel','status' => '1','clicks' => '5395','data_nasc' => '2016-12-23 17:03:57','data_last' => '2016-12-23 17:03:57'),
            array('id' => '37','nome' => 'Rodvus Novels','site' => 'http://rodvusnovels.blogspot.com.br/','feed' => 'http://feeds.feedburner.com/rodvusnovels?format=xml','email' => 'rodvus@gmail.com','url' => 'rodvusnovels','status' => '1','clicks' => '616','data_nasc' => '2016-12-24 18:52:15','data_last' => '2016-12-24 18:52:15'),
            array('id' => '38','nome' => '[GG]','site' => 'https://ggwpsubs.wordpress.com/','feed' => 'https://ggwpsubs.wordpress.com/category/light-novel/feed/','email' => 'allokz2017@gmail.com','url' => 'ggwpsubs','status' => '1','clicks' => '368','data_nasc' => '2017-01-16 01:16:46','data_last' => '2017-01-16 01:16:46'),
            array('id' => '39','nome' => 'DouQian','site' => 'http://douqian.wordpress.com/','feed' => 'http://douqian.wordpress.com/feed/','email' => 'douglas-gd@hotmail.com','url' => 'douqian','status' => '1','clicks' => '185','data_nasc' => '2017-01-17 19:26:58','data_last' => '2017-01-17 19:26:58'),
            array('id' => '40','nome' => 'Infinite Novels','site' => 'https://infinitenovelsite.wordpress.com/','feed' => 'https://infinitenovelsite.wordpress.com/feed/','email' => '','url' => 'infinitenovels','status' => '1','clicks' => '1151','data_nasc' => '0000-00-00 00:00:00','data_last' => '2017-01-22 17:57:20'),
            array('id' => '41','nome' => 'Fourleave Scan','site' => 'http://fourleavescan.com.br','feed' => 'http://fourleavescan.com.br/feed','email' => 'alessandrozullu@hotmail.com','url' => 'fourleavescan','status' => '1','clicks' => '1414','data_nasc' => '2017-01-30 15:47:25','data_last' => '2017-01-30 15:47:25'),
            array('id' => '42','nome' => 'Walker Field','site' => 'http://walkerfield.com.br/','feed' => 'http://walkerfield.com.br/feed/','email' => 'MATHEUSS.OLIVEIRA2@GMAIL.COM','url' => 'walkerfield','status' => '1','clicks' => '902','data_nasc' => '2017-02-05 13:59:33','data_last' => '2017-02-05 13:59:33'),
            array('id' => '44','nome' => 'Life Hourglass','site' => 'https://lifehourglass.wordpress.com','feed' => 'https://lifehourglass.wordpress.com/feed/','email' => 'yahs306@gmail.com','url' => 'LifeHourglass','status' => '1','clicks' => '429','data_nasc' => '2017-02-14 20:47:36','data_last' => '2017-02-14 20:47:36'),
            array('id' => '46','nome' => '3Lobos','site' => 'http://3lobos.org/','feed' => 'http://3lobos.org/feed/','email' => 'deodoroaliguieri@gmail.com','url' => '3lobos','status' => '1','clicks' => '16978','data_nasc' => '2017-03-22 02:54:34','data_last' => '2017-03-22 02:54:34'),
            array('id' => '48','nome' => 'Yggard Novel','site' => 'https://yggwntradutor.wordpress.com/','feed' => 'https://yggwntradutor.wordpress.com/feed/','email' => 'yulion.estevam@gmail.com','url' => 'yggwntradutor','status' => '1','clicks' => '233','data_nasc' => '2017-04-16 22:46:04','data_last' => '2017-04-16 22:46:04'),
            array('id' => '51','nome' => 'Menduba Tales','site' => 'https://www.mendubatales.wordpress.com','feed' => 'https://mendubatales.wordpress.com/feed/','email' => 'bigvyctor@gmail.com','url' => 'MendubaTales','status' => '0','clicks' => '94','data_nasc' => '2017-06-16 14:53:36','data_last' => '2017-06-16 14:53:36'),
            array('id' => '54','nome' => 'Kaslluplast','site' => 'http://kaslluplast.xyz/','feed' => 'http://kaslluplast.xyz/feed/','email' => 'klauskallu@gmail.com','url' => 'kaslluplast','status' => '1','clicks' => '2763','data_nasc' => '2017-06-22 23:23:46','data_last' => '2017-06-22 23:23:46'),
            array('id' => '55','nome' => 'CivManiac Novels','site' => 'http://civmaniacnovels.wordpress.com/','feed' => 'http://civmaniacnovels.wordpress.com/feed','email' => 'civmaniacnovels@gmail.com','url' => 'civmaniacnovels','status' => '1','clicks' => '776','data_nasc' => '2017-06-25 13:48:18','data_last' => '2017-06-25 13:48:18'),
            array('id' => '56','nome' => 'Zorgnatron','site' => 'http://www.zorgnatron.com.br/','feed' => 'http://www.zorgnatron.com.br/feed/','email' => 'contato@zorgnatron.com.br','url' => 'Zorgnatron','status' => '0','clicks' => '54','data_nasc' => '2017-06-26 13:00:00','data_last' => '2017-06-26 16:36:01'),
            array('id' => '57','nome' => 'Central of Slaves','site' => 'http://centralofslaves.com.br/','feed' => 'http://centralofslaves.com.br/feed/','email' => 'centralofslaves@gmail.com','url' => 'centralofslaves','status' => '1','clicks' => '3084','data_nasc' => '2017-06-29 00:06:06','data_last' => '2017-06-29 00:06:06'),
            array('id' => '58','nome' => 'PBS Brazil','site' => 'https://peerlessbattlespirit.wordpress.com','feed' => 'https://peerlessbattlespirit.wordpress.com/feed/','email' => 'pbsbrazil10@gmail.com','url' => 'pbsbrazil','status' => '1','clicks' => '374','data_nasc' => '2017-07-16 00:10:12','data_last' => '2017-07-16 00:10:12'),
            array('id' => '61','nome' => 'Peanut Novels','site' => 'https://peanutnovels.wordpress.com','feed' => 'https://peanutnovels.wordpress.com/feed/','email' => 'vyckpeanut@gmail.com','url' => 'peanutnovels','status' => '1','clicks' => '97','data_nasc' => '2017-07-28 14:53:07','data_last' => '2017-07-28 14:53:07'),
            array('id' => '62','nome' => 'Boys Love Brasil','site' => 'https://boyslovebrasil.wordpress.com','feed' => 'https://boyslovebrasil.wordpress.com/feed/','email' => 'boyslovebrasil@outlook.com','url' => 'boyslovebrasil','status' => '1','clicks' => '249','data_nasc' => '2017-08-04 03:06:56','data_last' => '2017-08-04 03:06:56'),
            array('id' => '63','nome' => 'Miko Traduções','site' => 'https://templodamiko.blogspot.com.br/','feed' => 'https://templodamiko.blogspot.com/feeds/posts/default?alt=rss','email' => 'jairgsjunior@gmail.com','url' => 'templodamiko','status' => '1','clicks' => '891','data_nasc' => '2017-08-08 21:18:40','data_last' => '2017-08-08 21:18:40'),
            array('id' => '64','nome' => 'SteinsGod','site' => 'https://steinsgod.wordpress.com/','feed' => 'https://steinsgod.wordpress.com/feed','email' => '','url' => 'steinsgod','status' => '1','clicks' => '101','data_nasc' => '2017-08-09 14:05:04','data_last' => '2017-08-09 14:05:04'),
            array('id' => '66','nome' => 'Legado Novel','site' => 'https://legadonovel.wordpress.com','feed' => 'https://legadonovel.wordpress.com/feed/','email' => 'legadonovel@gmail.com','url' => 'legadonovel','status' => '0','clicks' => '26','data_nasc' => '2017-08-18 18:28:47','data_last' => '2017-08-18 18:28:47'),
            array('id' => '67','nome' => 'Novel Brasil','site' => 'https://novelbrl.wordpress.com','feed' => 'https://novelbrl.wordpress.com/feed/','email' => 'keepnaipsss@gmail.com','url' => 'keepnaipsss','status' => '1','clicks' => '153','data_nasc' => '2017-09-02 18:53:01','data_last' => '2017-09-02 18:53:01'),
            array('id' => '73','nome' => 'Renascimento do Lendário Tradutor','site' => 'https://rebirthofthelegendarytranslator.wordpress.com/','feed' => 'https://rebirthofthelegendarytranslator.wordpress.com/feed/','email' => 'yeqiuu@gmail.com','url' => 'rebirthofthelegendary','status' => '1','clicks' => '116','data_nasc' => '2017-09-09 12:00:54','data_last' => '2017-09-09 12:00:54'),
            array('id' => '74','nome' => 'Velho Grimório Traduções','site' => 'https://velhogrimorio.wordpress.com/','feed' => 'https://velhogrimorio.wordpress.com/feed/','email' => '','url' => 'velhogrimorio','status' => '1','clicks' => '71','data_nasc' => '2017-09-15 01:30:07','data_last' => '2017-09-15 01:30:07'),
            array('id' => '75','nome' => 'Vulcan Novels','site' => 'https://vulcannovels.wordpress.com','feed' => 'https://vulcannovels.wordpress.com/feed/','email' => 'vulcanovels@gmail.com','url' => 'vulcannovels','status' => '1','clicks' => '3828','data_nasc' => '2017-09-26 00:47:51','data_last' => '2017-09-26 00:47:51'),
            array('id' => '76','nome' => 'Incognito Novels','site' => 'https://incognitonovels.wordpress.com/','feed' => 'https://incognitonovels.wordpress.com/feed/','email' => 'incognitonovels@gmail.com','url' => 'incognitonovels','status' => '1','clicks' => '190','data_nasc' => '2017-10-09 00:00:00','data_last' => '2017-10-09 00:00:00'),
            array('id' => '77','nome' => 'Cloud Novels','site' => 'https://cloudnovels.com.br','feed' => 'https://cloudnovels.com.br/rss','email' => 'igor_augusto_ss@hotmail.com','url' => 'cloudnovels','status' => '1','clicks' => '3818','data_nasc' => '2017-10-15 17:10:32','data_last' => '2017-10-15 17:10:32'),
            array('id' => '80','nome' => 'Traduzindo Novels','site' => 'http://traduzindonovels.com.br/','feed' => 'http://traduzindonovels.com.br/feed/','email' => 'null','url' => 'traduzindonovels','status' => '1','clicks' => '3615','data_nasc' => '2017-10-26 12:00:00','data_last' => '2017-10-26 12:43:08'),
            array('id' => '81','nome' => 'Palácio do Dao','site' => 'http://novels.com.br/','feed' => 'http://novels.com.br/feed/','email' => 'null','url' => 'palaciododao','status' => '1','clicks' => '2230','data_nasc' => '2017-11-02 00:00:00','data_last' => '2017-11-02 11:49:05','tipo'=>'2'),
            array('id' => '82','nome' => 'Ikigai Traduções','site' => 'https://ikigaitraducoes.wordpress.com/','feed' => 'https://ikigaitraducoes.wordpress.com/feed/','email' => 'alison.varjolo@yahoo.com.br','url' => 'ikigaitraducoes','status' => '1','clicks' => '288','data_nasc' => '2017-11-15 11:23:33','data_last' => '2017-11-15 11:23:33'),
            array('id' => '83','nome' => 'Novel Temple','site' => 'https://noveltemple.com/','feed' => 'https://noveltemple.com/feed/','email' => 'noveltemple@gmail.com','url' => 'noveltemple','status' => '1','clicks' => '713','data_nasc' => '2017-11-16 15:44:13','data_last' => '2017-11-16 15:44:13'),
            array('id' => '84','nome' => 'Power Scan BR','site' => 'https://powerscanbr.wordpress.com','feed' => 'https://powerscanbr.wordpress.com/feed','email' => 'bielsouzaneves@outlook.com','url' => 'powerscanbr','status' => '1','clicks' => '168','data_nasc' => '2017-11-19 12:48:54','data_last' => '2017-11-19 12:48:54'),
            array('id' => '85','nome' => 'RoseKethen','site' => 'https://rosekethen.wordpress.com','feed' => 'https://rosekethen.wordpress.com/feed/','email' => 'richiegules@gmail.com','url' => 'rosekethen','status' => '1','clicks' => '486','data_nasc' => '2017-11-20 00:01:44','data_last' => '2017-11-20 00:01:44')
          );
        
        foreach($grupos as $grupo){
            $Grupo = App\Grupo::create([
                'nome'  => $grupo['nome'],
                'site'  => $grupo['site'],
                'feed'  => $grupo['feed'],
                'url'   => $grupo['url'],
                'categoria_id'   => (isset($grupo['tipo']) ? $grupo['tipo'] : '1'),
                'status'   => $grupo['status']
            ]);
        }

        $Conquista = \App\Conquista::find(1);
        $Conquista->grupo()->sync(1);
    }
}