<?php

use App\Models\UsersPost;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = UsersPost::get();
        $data = [];
        $names = [
            [
                "name"=> "Юлия",
                "secName"=> "Филина",
                "thirdName"=> "Игоревна",
                "email"=> null
            ],
            [
                "name"=> "Ольга",
                "secName"=> "Солдатова",
                "thirdName"=> "Борисовна",
                "email"=> "o.b.soldatova@mpt.ru"
            ],
            [
                "name"=> "Алена",
                "secName"=> "Ситникова",
                "thirdName"=> "Алексеевна",
                "email"=> "nulla.a.sitnikova@mpt.ru"
            ],
            [
                "name"=> "Александр",
                "secName"=> "Сачков",
                "thirdName"=> "Николаевич",
                "email"=> null
            ],
            [
                "name"=> "Димитриос",
                "secName"=> "Салоникес",
                "thirdName"=> "Михалис",
                "email"=> "d.m.salonikes@mpt.ru"
            ],
            [
                "name"=> "Сергей",
                "secName"=> "Пятчиц",
                "thirdName"=> "Сергеевич",
                "email"=> null
            ],
            [
                "name"=> "Андрей",
                "secName"=> "Пучков",
                "thirdName"=> "Анатольевич",
                "email"=> "a.a.puchkov@mpt.ru"
            ],
            [
                "name"=> "Надежда",
                "secName"=> "Нечаева",
                "thirdName"=> "Ильинична",
                "email"=> "n.i.nechaeva@mpt.com"
            ],
            [
                "name"=> "Елена",
                "secName"=> "Марченко",
                "thirdName"=> "Юрьевна",
                "email"=> "nulle.yu.marchenko@mpt.ru"
            ],
            [
                "name"=> "Павел",
                "secName"=> "Маркин",
                "thirdName"=> "Александрович",
                "email"=> null
            ],
            [
                "name"=> "Антон",
                "secName"=> "Лясников",
                "thirdName"=> "Олегович",
                "email"=> "a.o.lyasnikov@mpt.ru"
            ],
            [
                "name"=> "Нонна",
                "secName"=> "Леденчук",
                "thirdName"=> "Станиславовна",
                "email"=> "nulln.s.ledenchuk@mpt.ru"
            ],
            [
                "name"=> "Анастасия",
                "secName"=> "Завьялова",
                "thirdName"=> "Дмитриевна",
                "email"=> null
            ],
            [
                "name"=> "Кирилл",
                "secName"=> "Жданцев",
                "thirdName"=> "Николаевич",
                "email"=> "k.n.zhdantsev@mpt.ru"
            ],
            [
                "name"=> "Михаил",
                "secName"=> "Горшков",
                "thirdName"=> "Николаевич",
                "email"=> "m.n.gorshkov@mpt.ru"
            ],
            [
                "name"=> "Ирина",
                "secName"=> "Воронина",
                "thirdName"=> "Сергеевна",
                "email"=> "i.s.voronina@mpt.ru"
            ],
            [
                "name"=> "Наталья",
                "secName"=> "Белоусова",
                "thirdName"=> "Вячеславовна",
                "email"=> null
            ],
            [
                "name"=> "Алевтина",
                "secName"=> "Бабичева",
                "thirdName"=> "Викторовна",
                "email"=> "a.v.babicheva@mpt.ru"
            ],
            [
                "name"=> "Яна",
                "secName"=> "Михайлова",
                "thirdName"=> "Витальевна",
                "email"=> "ya.v.mihailova@mpt.ru"
            ],
            [
                "name"=> "Варвара",
                "secName"=> "Курносова",
                "thirdName"=> "Андреевна",
                "email"=> "v.a.kurnosova@mpt.ru"
            ],
            [
                "name"=> "Светлана",
                "secName"=> "Кицына",
                "thirdName"=> "Павловна",
                "email"=> "s.p.kicina@mpt.ru"
            ],
            [
                "name"=> "Андрей",
                "secName"=> "Чурилов",
                "thirdName"=> "Викторович",
                "email"=> "a.v.churilov@mpt.ru"
            ],
            [
                "name"=> "Борис",
                "secName"=> "Хруленко",
                "thirdName"=> "Григорьевич",
                "email"=> "b.g.hrulenko@mpt.ru"
            ],
            [
                "name"=> "Владлен",
                "secName"=> "Ключник",
                "thirdName"=> "Иванович",
                "email"=> "v.i.kluchnik@mpt.ru"
            ],
            [
                "name"=> "Георгий",
                "secName"=> "Губарьков",
                "thirdName"=> "Владимирович",
                "email"=> "g.v.gubarkov@mpt.ru"
            ],
            [
                "name"=> "Эмма",
                "secName"=> "Голеусова",
                "thirdName"=> "Владимировна",
                "email"=> "e.v.goleusova@mpt.ru"
            ],
            [
                "name"=> "Юлия",
                "secName"=> "Мамошкина",
                "thirdName"=> "Владиславовна",
                "email"=> "yu.v.mamoshkina@mpt.ru"
            ],
            [
                "name"=> "Илья",
                "secName"=> "Козик",
                "thirdName"=> "Дмитриевич",
                "email"=> "i.d.kozik@mpt.ru"
            ],
            [
                "name"=> "Никита",
                "secName"=> "Митасов",
                "thirdName"=> "Сергеевич",
                "email"=> "n.s.mitasov@mpt.ru"
            ],
            [
                "name"=> "Александр",
                "secName"=> "Канакин",
                "thirdName"=> "Викторович",
                "email"=> "a.v.kanakin@mpt.ru"
            ],
            [
                "name"=> "Татьяна",
                "secName"=> "Чурилова",
                "thirdName"=> "Юрьевна",
                "email"=> "t.yu.churilova@mpt.ru"
            ],
            [
                "name"=> "Анастасия",
                "secName"=> "Павлова",
                "thirdName"=> "Витальевна",
                "email"=> "a.v.pavlova@mpt.ru"
            ],
            [
                "name"=> "Андрей",
                "secName"=> "Бабошин",
                "thirdName"=> "Сергеевич",
                "email"=> "a.s.baboshin@mpt.ru"
            ],
            [
                "name"=> "Сергей",
                "secName"=> "Журкин",
                "thirdName"=> "Александрович",
                "email"=> "s.a.zhurkin@mpt.ru"
            ],
            [
                "name"=> "Елена",
                "secName"=> "Добрынина",
                "thirdName"=> "Вахтанговна",
                "email"=> "e.v.dobrinina@mpt.ru"
            ],
            [
                "name"=> "Полина",
                "secName"=> "Вредник",
                "thirdName"=> "Руслановна",
                "email"=> "p.r.vrednik@mpt.ru"
            ],
            [
                "name"=> "Андрей",
                "secName"=> "Аскольский",
                "thirdName"=> "Викторович",
                "email"=> "a.v.askoldskiy@mpt.ru"
            ],
            [
                "name"=> "Наталья",
                "secName"=> "Кузнецова",
                "thirdName"=> "Сергеевна",
                "email"=> "n.s.kuznecova@mpt.ru"
            ],
            [
                "name"=> "Татьяна",
                "secName"=> "Ющенко",
                "thirdName"=> "Николаевна",
                "email"=> "engenia2945@ya.ru"
            ],
            [
                "name"=> "Александр",
                "secName"=> "Господариков",
                "thirdName"=> "Александрович",
                "email"=> null
            ],
            [
                "name"=> "Анастасия",
                "secName"=> "Полосина",
                "thirdName"=> "Михайловна",
                "email"=> "a.m.polosina@mpt.ru"
            ],
            [
                "name"=> "Раиса",
                "secName"=> "Николаева",
                "thirdName"=> "Александровна",
                "email"=> "r.a.nikolaeva@mpt.ru"
            ],
            [
                "name"=> "Анна",
                "secName"=> "Дымская",
                "thirdName"=> "Юрьевна",
                "email"=> "a.yu.dimskaya@mpt.ru"
            ],
            [
                "name"=> "Игорь",
                "secName"=> "Захаренков",
                "thirdName"=> "Олегович",
                "email"=> null
            ],
            [
                "name"=> "Иван",
                "secName"=> "Морозов",
                "thirdName"=> "Андреевич",
                "email"=> "i.a.morozov@mpt.ru"
            ],
            [
                "name"=> "Каролина",
                "secName"=> "Батенко",
                "thirdName"=> "Евгеньевна",
                "email"=> null
            ],
            [
                "name"=> "Алина",
                "secName"=> "Каминьски",
                "thirdName"=> "Романовна",
                "email"=> "a.r.kaminski@mpt.ru"
            ],
            [
                "name"=> "Светлана",
                "secName"=> "Карасева",
                "thirdName"=> "Андреевна",
                "email"=> "s.a.karaseva@mpt.ru"
            ],
            [
                "name"=> "Андрей",
                "secName"=> "Шимбирёв",
                "thirdName"=> "Андреевич",
                "email"=> "a.a.shimbirev@mpt.ru"
            ],
            [
                "name"=> "Александр",
                "secName"=> "Токарчук",
                "thirdName"=> "Сергеевич",
                "email"=> "a.s.tokarchuk@mpt.ru"
            ],
            [
                "name"=> "Андрей",
                "secName"=> "Комаров",
                "thirdName"=> "Алексеевич",
                "email"=> "a.a.komarov@mpt.ru"
            ],
            [
                "name"=> "Сергей",
                "secName"=> "Караваев",
                "thirdName"=> "Владимирович",
                "email"=> null
            ],
            [
                "name"=> "Алексей",
                "secName"=> "Дубовик",
                "thirdName"=> "Сергеевич",
                "email"=> "a.s.dubovik@mpt.ru"
            ],
            [
                "name"=> "Антон",
                "secName"=> "Горбунов",
                "thirdName"=> "Дмитриевич",
                "email"=> "a.d.gorbunov@mpt.ru"
            ],
            [
                "name"=> "Галина",
                "secName"=> "Волкова",
                "thirdName"=> "Юрьевна",
                "email"=> "g.yu.volkova@mpt.ru"
            ],
            [
                "name"=> "Александр",
                "secName"=> "Ермаков",
                "thirdName"=> "Вадимович",
                "email"=> "a.v.ermakov@mpt.ru"
            ],
            [
                "name"=> "Дмитрий",
                "secName"=> "Готовец",
                "thirdName"=> "Михайлович",
                "email"=> "d.m.gotovets@mpt.ru"
            ],
            [
                "name"=> "Виктор",
                "secName"=> "Познахирко",
                "thirdName"=> "Викторович",
                "email"=> "v.v.poznahirko@mpt.ru"
            ],
            [
                "name"=> "Татьяна",
                "secName"=> "Попова",
                "thirdName"=> "Алексеевна",
                "email"=> "t.a.popova@mpt.ru"
            ],
            [
                "name"=> "Александр",
                "secName"=> "Соколов",
                "thirdName"=> "Леонидович",
                "email"=> " a.l.sokolov@mpt.ru"
            ],
            [
                "name"=> "Иван",
                "secName"=> "Щаников",
                "thirdName"=> "Максимович",
                "email"=> "i.m.shchanikov@mpt.ru"
            ],
            [
                "name"=> "Лариса",
                "secName"=> "Соколова",
                "thirdName"=> "Алексеевна",
                "email"=> " l.a.sokolova@mpt.ru"
            ],
            [
                "name"=> "Ольга",
                "secName"=> "Шестакова",
                "thirdName"=> "Николаевна",
                "email"=> "o.n.shestakova@mpt.ru"
            ],
            [
                "name"=> "Галина",
                "secName"=> "Зиновьева",
                "thirdName"=> "Михайловна",
                "email"=> "gmzinoveva@mpt.ru"
            ],
            [
                "name"=> "Юлия",
                "secName"=> "Милющенко",
                "thirdName"=> "Александровна",
                "email"=> "yu.a.milyushenko@mpt.ru"
            ],
            [
                "name"=> "Максим",
                "secName"=> "Молотков",
                "thirdName"=> "Алексеевич",
                "email"=> "m.a.molotkov@mpt.ru"
            ],
            [
                "name"=> "Михаил",
                "secName"=> "Прищеп",
                "thirdName"=> "Сергеевич",
                "email"=> " m.s.prischep@mpt.ru"
            ],
            [
                "name"=> "Павел",
                "secName"=> "Агафонов",
                "thirdName"=> "Витальевич",
                "email"=> " p.v.agafonov@mpt.ru"
            ],
            [
                "name"=> "Егор",
                "secName"=> "Лытнев",
                "thirdName"=> "Павлович",
                "email"=> " e.p.lytnev@mpt.ru"
            ],
            [
                "name"=> "Иван",
                "secName"=> "Володин",
                "thirdName"=> "Михайлович",
                "email"=> "i.m.volodin@mpt.ru"
            ],
            [
                "name"=> "Андрей",
                "secName"=> "Федотов",
                "thirdName"=> "Геннадьевич",
                "email"=> "a.g.fedotov@mpt.ru"
            ],
            [
                "name"=> "Андрей",
                "secName"=> "Вилков",
                "thirdName"=> "Николаевич",
                "email"=> "a.n.vilkov@mpt.ru"
            ],
            [
                "name"=> "Максим",
                "secName"=> "Синдикаев",
                "thirdName"=> "Витальевич",
                "email"=> "m.v.sindikaev@mpt.ru"
            ],
            [
                "name"=> "Александр",
                "secName"=> "Жуков",
                "thirdName"=> "Андреевич",
                "email"=> "a.a.zhukov@mpt.ru"
            ],
            [
                "name"=> "Надежда",
                "secName"=> "Бибикова",
                "thirdName"=> "Владимировна",
                "email"=> "n.v.bibikova@mpt.ru"
            ],
            [
                "name"=> "Екатерина",
                "secName"=> "Ермашенко",
                "thirdName"=> "Антоновна",
                "email"=> "e.a.ermashenko@mpt.ru"
            ],
            [
                "name"=> "Лариса",
                "secName"=> "Чернышова",
                "thirdName"=> "Анатольевна",
                "email"=> "l.a.chernishova@mpt.ru"
            ],
            [
                "name"=> "Эльмира",
                "secName"=> "Хисяметдинова",
                "thirdName"=> "Шамильевна",
                "email"=> "e.sh.hisyametdinova@mpt.ru"
            ],
            [
                "name"=> "Анатолий",
                "secName"=> "Судоплатов",
                "thirdName"=> "Родионович",
                "email"=> "a.r.sudoplatov@mpt.ru"
            ],
            [
                "name"=> "Константин",
                "secName"=> "Стасевич",
                "thirdName"=> "Владимирович",
                "email"=> "k.v.stasevich@mpt.ru"
            ],
            [
                "name"=> "Галина",
                "secName"=> "Синегубова",
                "thirdName"=> "Олеговна",
                "email"=> "g.o.efankina@mpt.ru"
            ],
            [
                "name"=> "Анна",
                "secName"=> "Петрова",
                "thirdName"=> "Владимировна",
                "email"=> "a.v.petrova@mpt.ru"
            ],
            [
                "name"=> "Наталья",
                "secName"=> "Николаева",
                "thirdName"=> "Гаррьевна",
                "email"=> "n.g.nikolaeva@mpt.ru"
            ],
            [
                "name"=> "Константин",
                "secName"=> "Минаев",
                "thirdName"=> "Алексеевич",
                "email"=> "k.a.minaev@mpt.ru"
            ],
            [
                "name"=> "Анна",
                "secName"=> "Лосикова",
                "thirdName"=> "Львовна",
                "email"=> "a.l.losikova@mpt.ru"
            ],
            [
                "name"=> "Алина",
                "secName"=> "Карцева",
                "thirdName"=> "Викторовна",
                "email"=> "a.v.karceva@mpt.ru"
            ],
            [
                "name"=> "Полина",
                "secName"=> "Елистратова",
                "thirdName"=> "Алексеевна",
                "email"=> "p.a.elistratova@mpt.ru"
            ],
            [
                "name"=> "Олег",
                "secName"=> "Евдокименко",
                "thirdName"=> "Архипович",
                "email"=> "o.a.evdokimenko@mpt.ru"
            ],
            [
                "name"=> "Любовь",
                "secName"=> "Дробышева",
                "thirdName"=> "Викторовна",
                "email"=> "l.v.drobisheva@mpt.ru"
            ],
            [
                "name"=> "Александр",
                "secName"=> "Джебилов",
                "thirdName"=> "Валерьевич",
                "email"=> "a.v.dzhebilov@mpt.ru"
            ],
            [
                "name"=> "Татьяна",
                "secName"=> "Галкина",
                "thirdName"=> "Михайловна",
                "email"=> "t.m.galkina@mpt.ru"
            ],
            [
                "name"=> "Ольга",
                "secName"=> "Водопьянова",
                "thirdName"=> "Анатольевна",
                "email"=> "o.a.vodopyanova@mpt.ru"
            ],
            [
                "name"=> "Сергей",
                "secName"=> "Виноградов",
                "thirdName"=> "Владимирович",
                "email"=> "s.v.vinogradov@mpt.ru"
            ],
            [
                "name"=> "Юлия",
                "secName"=> "Господарикова",
                "thirdName"=> "Игоревна",
                "email"=> "yu.i.blinova@mpt.ru"
            ],
            [
                "name"=> "Сергей",
                "secName"=> "Абрамов",
                "thirdName"=> "Антонидович",
                "email"=> "s.a.abramov@mpt.ru"
            ],
            [
                "name"=> "Татьяна",
                "secName"=> "Маковская",
                "thirdName"=> "Сергеевна",
                "email"=> "t.s.makovskaya@mpt.ru"
            ],
            [
                "name"=> "Константин",
                "secName"=> "Мотыльков",
                "thirdName"=> "Владимирович",
                "email"=> "k.v.motylkov@mpt.ru"
            ],
            [
                "name"=> "Нонна",
                "secName"=> "Супрунова",
                "thirdName"=> "Александровна",
                "email"=> "n.a.suprunova@mpt.ru"
            ],
            [
                "name"=> "Наталья",
                "secName"=> "Соловьева",
                "thirdName"=> "Юрьевна",
                "email"=> "n.yu.soloveva@mpt.ru"
            ],
            [
                "name"=> "Михаил",
                "secName"=> "Гуленков",
                "thirdName"=> "Сергеевич",
                "email"=> "m.s.gulenkov@mpt.ru"
            ],
            [
                "name"=> "Евгений",
                "secName"=> "Рябов",
                "thirdName"=> "Алексеевич",
                "email"=> "e.a.ryabov@mpt.ru"
            ],
            [
                "name"=> "Михаил",
                "secName"=> "Николаенко",
                "thirdName"=> "Сергеевич",
                "email"=> "m.s.nikolaenko@mpt.ru"
            ],
            [
                "name"=> "Владимир",
                "secName"=> "Никишин",
                "thirdName"=> "Олегович",
                "email"=> "v.o.nikishin@mpt.ru"
            ],
            [
                "name"=> "Римма",
                "secName"=> "Клейман",
                "thirdName"=> "Яковлевна",
                "email"=> "r.ya.kleyman@mpt.ru"
            ],
            [
                "name"=> "Игорь",
                "secName"=> "Блинов",
                "thirdName"=> "Александрович",
                "email"=> "i.a.blinov@mpt.ru"
            ],
            [
                "name"=> "Светлана",
                "secName"=> "Андрианова",
                "thirdName"=> "Сергеевна",
                "email"=> "s.s.andrianova@mpt.ru"
            ],
            [
                "name"=> "Амиль",
                "secName"=> "Азизов",
                "thirdName"=> "Камилевич",
                "email"=> "a.k.azizov@mpt.ru"
            ],
            [
                "name"=> "Андрей",
                "secName"=> "Андрюков",
                "thirdName"=> "Викторович",
                "email"=> "a.v.andryukov@mpt.ru"
            ],
            [
                "name"=> "Роман",
                "secName"=> "Волков",
                "thirdName"=> "Юрьевич",
                "email"=> "r.yu.volkov@mpt.ru"
            ],
            [
                "name"=> "Наталья",
                "secName"=> "Ключник",
                "thirdName"=> "Евгеньевна",
                "email"=> "n.e.klyuchnik@mpt.ru"
            ],
            [
                "name"=> "Мария",
                "secName"=> "Кирюхина",
                "thirdName"=> "Николаевна",
                "email"=> "m.n.kiruhina@mpt.ru"
            ],
            [
                "name"=> "Юлия",
                "secName"=> "Калашникова",
                "thirdName"=> "Андреевна",
                "email"=> "yu.a.kalashnikova@mpt.ru"
            ],
            [
                "name"=> "Мария",
                "secName"=> "Прищеп",
                "thirdName"=> "Сергеевна",
                "email"=> "mar.s.prischep@mpt.ru"
            ],
            [
                "name"=> "Елена",
                "secName"=> "Селиверстова",
                "thirdName"=> "Анатольевна",
                "email"=> "test@email.com"
            ],
            [
                "name"=> "Надежда",
                "secName"=> "Свобода",
                "thirdName"=> "Владимировна",
                "email"=> "n.v.svoboda@mpt.ru"
            ],
            [
                "name"=> "Вероника",
                "secName"=> "Волкова",
                "thirdName"=> "Вадимовна",
                "email"=> "v.v.golovina@mpt.ru"
            ],
            [
                "name"=> "Надежда",
                "secName"=> "Петкова",
                "thirdName"=> "Евгеньевна",
                "email"=> "n.e.petkova@mpt.ru"
            ],
            [
                "name"=> "Оксана",
                "secName"=> "Мещеринова",
                "thirdName"=> "Леонтьевна",
                "email"=> "o.l.mescherinova@mpt.ru"
            ],
            [
                "name"=> "Наталия",
                "secName"=> "Андреева",
                "thirdName"=> "Алексеевна",
                "email"=> "n.a.andreeva@mpt.ru"
            ],
            [
                "name"=> "Дмитрий",
                "secName"=> "Клопов",
                "thirdName"=> "Анатольевич",
                "email"=> "d.a.klopov@mpt.ru"
            ],
            [
                "name"=> "Ирина",
                "secName"=> "Ермачкова",
                "thirdName"=> "Юрьевна",
                "email"=> "i.yu.ermachkova@mpt.ru"
            ],
            [
                "name"=> "Татьяна",
                "secName"=> "Руденко",
                "thirdName"=> "Владимировна",
                "email"=> "t.v.rudenko@mpt.ru"
            ],
            [
                "name"=> "Ольга",
                "secName"=> "Кирюхина",
                "thirdName"=> "Николаевна",
                "email"=> "o.n.kiruhina@mpt.ru"
            ],
            [
                "name"=> "Марина",
                "secName"=> "Зимогорова",
                "thirdName"=> "Владимировна",
                "email"=> "m.v.zimogorova@mpt.ru"
            ],
            [
                "name"=> "Татьяна",
                "secName"=> "Позднякова",
                "thirdName"=> "Игоревна",
                "email"=> "t.i.pozdnyakova@mpt.ru"
            ],
            [
                "name"=> "Любовь",
                "secName"=> "Попова",
                "thirdName"=> "Юрьевна",
                "email"=> "l.yu.popova@mpt.ru"
            ],
            [
                "name"=> "Павел",
                "secName"=> "Кузнецов",
                "thirdName"=> "Олегович",
                "email"=> "p.o.kuznetsov@mpt.ru"
            ]
        ];

        foreach ($roles as $role) {
           array_push($data,[
            'name'=>$role->slug,
            'secName'=>"",
            'thirdName'=>"",
            'email'=>$role->slug."@mpt.ru",
            'password' =>Hash::make("secret"),
            'disabled' =>false,
            'post_id' => $role->id
           ]);
        }
        $cyr = [
            'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
            'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я'
        ];
        $lat = [
            'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
            'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya'
        ];
        foreach($names as $dat){
            array_push($data,[
                'name'=>$dat["name"],
                'secName'=>$dat["secName"],
                'thirdName'=>$dat["thirdName"],
                'email'=>$dat['email'] ?? str_replace($cyr, $lat, Str::lower($dat["name"]))[0].".".str_replace($cyr, $lat, Str::lower($dat["thirdName"]))[0].".".str_replace($cyr, $lat, Str::lower($dat["secName"]))."@mpt.ru",
                'password' =>Hash::make("secret"),
                'disabled' =>false,
                'post_id' => 3
               ]);
        }

        DB::table("users")->insert($data);
    }
}