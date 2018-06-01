<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CarsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table( 'cars' )->insert( [
			'category_id' => 1,
			'name'        => 'BMW X3',
			'price'       => 30000.00,
			'year'        => '2015',
			'km'          => '20000',
			'image'       => 'bmw_x3.jpg',
			'status'      => 1,
			'default'     => 1,
			'description' => 'BMW X3, SAV( Sport Activity Vehicle) automobil je s petero vrata i prvi put je predstavljen 2003.godine kao manja verzija BMW X5. Za razliku od svog prethodnika niži je nekoliko centimetara. Možete izabrati između šest motora ,od kojih su četiri benzinska i među njima se najviše ističe najjači model BMW X3 xDrive 35i. Šest- cilindarski motor sa snagom od 306 KS u samo 6,2 sekunde dostiže brzinu od 100km/h,a maksimalna brzina mu je 250km/h.',
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now(),
			'user_id'     => 1
		] );
		
		DB::table( 'cars' )->insert( [
			'category_id' => 1,
			'name'        => 'BMW Serie 3 340i (2015)',
			'price'       => 40000.00,
			'year'        => '2015',
			'km'          => '15000',
			'image'       => 'bmw_serie3.jpg',
			'status'      => 1,
			'default'     => 1,
			'description' => 'BMW serije 3 je automobil iz srednje klase njemačke marke BMW i proizvodi se od 1975. godine. Trenutačno je u proizvodnji peta generacija. Trojka je najprodavaniji BMW-ov model te nosi oko 40% ukupne BMW-ove proizvodnje te ujedno jedan od najpopularnijh automobila u svijetu.',
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now(),
			'user_id'     => 2
		] );
		
		DB::table( 'cars' )->insert( [
			'category_id' => 1,
			'name'        => 'BMW X4',
			'price'       => 37000.00,
			'year'        => '2016',
			'km'          => '25000',
			'image'       => 'bmw_x4.png',
			'status'      => 1,
			'default'     => 1,
			'description' => 'Dodatne informacije o zvaničnoj potrošnji goriva i emisiji CO2 gasova za nove putničke automobile se mogu pronaći u „Uputstvo za potrošnju goriva i emisiju CO2 gasova novih putničkih vozila“, koje je besplatno dostupno na svim prodajnim mestima i kod DAT Deutsche Automobil Treuhand GmbH, Hellmuth-Hirt-Str.1, 73760 Ostfildern, Nemačka.',
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now(),
			'user_id'     => 3
		] );
		
		DB::table( 'cars' )->insert( [
			'category_id' => 2,
			'name'        => 'Audi Q7',
			'price'       => 20000.00,
			'year'        => '2016',
			'km'          => '10000',
			'image'       => 'audi_q7.png',
			'status'      => 1,
			'default'     => 1,
			'description' => 'Audi Q7 je pokušaj ove njemačke marke automobila da se nametne na zahtjevnom tržištu luksuznih SUV-a. Nastao je iz konceptnog vozila Audi Pikes Peak, a prvi put je javnosti predstavljen na Frankfurtskom auto showu 2005. Izrađen na podlozi Porsche Cayennea i VW Touarega ovaj model ima velike šanse za uspjeh. Od konkurenata se razlikuje po tome što u serijskoj opremi nudi 7 sjedala, a u potpunosti je prilagođen vožnji na cesti.',
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now(),
			'user_id'     => 4
		] );
		
		DB::table( 'cars' )->insert( [
			'category_id' => 2,
			'name'        => 'Audi Q2 Sport',
			'price'       => 17500.00,
			'year'        => '2012',
			'km'          => '100000',
			'image'       => 'audi_q2_sport.png',
			'status'      => 1,
			'default'     => 1,
			'description' => 'Novi Audi Q2 stupa na pozornicu - urbani tip sa markantnim detaljima, samostalni karakter sa potpuno novim geometrijskim jezikom dizajna. Naglašeno samopouzdan i sa snažnim TFSI i TDI motorima snage 116 do 190 KS koji su opciono raspoloživi sa stalnim pogonom na sve točkove quattro. Njegova oprema ispunjava sve želje i sadrži nove elemente koji su do sada bili rezervisani samo za vrhunsku klasu automobila. A Connectivity? Primerno sa Audi smartphone interfejsom i najnovijom generacijom infotainment i sound sistema.',
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now(),
			'user_id'     => 5
		] );
		
		DB::table( 'cars' )->insert( [
			'category_id' => 2,
			'name'        => 'Audi A4 2.0 TDI S line',
			'price'       => 22000.00,
			'year'        => '2015',
			'km'          => '10000',
			'image'       => 'audi_a4.png',
			'status'      => 1,
			'default'     => 1,
			'description' => 'Audi A4 se proizvodio od 1994. - 2000. godine. Temeljen je na Volkswagen Passatu četvrte generacije. Karavan, kod Audija zvan Avant je došao 1995. 1997. je doživio blagi redizajn, a promijenjena su prednja i stražnja svjetla te su u ponudu dodani neki motori.',
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now(),
			'user_id'     => 6
		] );
		
		DB::table( 'cars' )->insert( [
			'category_id' => 3,
			'name'        => 'Mercedes C Class',
			'price'       => 40000.00,
			'year'        => '2017',
			'km'          => '15000',
			'image'       => 'mercedes_c_class.png',
			'status'      => 1,
			'default'     => 1,
			'description' => 'C-klasa je linija limuzina i karavana srednje klase, te hatchbacka kompaktne klase (samo u drugoj generaciji), koju proizvodi i prodaje Mercedes-Benz, a dosad je proizvedena u tri generacije. Zamjena je za model srednje klase 190. U vrijeme prve pojave na tržištu bio je najmanji i najpristupačnij model, sve do dolaska A-klase 1997.',
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now(),
			'user_id'     => 3
		] );
		
		DB::table( 'cars' )->insert( [
			'category_id' => 3,
			'name'        => 'Mercedes Benz AMG GT',
			'price'       => 100000.00,
			'year'        => '2018',
			'km'          => '0',
			'image'       => 'mercedes_amg.jpg',
			'status'      => 1,
			'default'     => 1,
			'description' => 'Mercedes AMG je deo agende „AMG Performance 50“ koja se prostire na period do 2017. godine, kada se slavi 50. godišnjica Mercedesovog sportskog odeljenja. ',
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now(),
			'user_id'     => 5
		] );
		
		DB::table( 'cars' )->insert( [
			'category_id' => 3,
			'name'        => 'Mercedes-Benz S-Coupe',
			'price'       => 16000.00,
			'year'        => '2014',
			'km'          => '150000',
			'image'       => 'mercedes_s.jpg',
			'status'      => 1,
			'default'     => 1,
			'description' => 'Mercedes-Benz S-klasa pripada najvišem razredu velikoserijskih automobila, a glavnu konkurenciju ovom modelu čine BMW serije 7, Audi A8, VW Phaeton i Jaguar XJ – type.

S ovim modelom, Mercedes nastoji kupcima ponuditi komfor na najvišoj razini, a kako bi u tome uspio, uložene su velike količine novaca, vremena i znanja u razvoj tog modela. Trenutno je S-klasa tehnološki najnapredniji automobil na svijetu i samo ga BMW sa serijom 7 uspijeva pratiti u stopu. Ono čime se S klasa posebno ističe je sigurnosni sustav koji predviđa neizbježni sudar (Pre-safe) te automobil dovodi u stanje najmanjeg rizika za ozljede putnika. Također, tu je i napredni sustav infracrvenog radara koji u noćnoj vožnji povećava vidljivost prikazivanjem digitalne slike na zaslonu automobila i time ukazuje na skrivene opasnosti na cesti.',
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now(),
			'user_id'     => 2
		] );
	}
}
