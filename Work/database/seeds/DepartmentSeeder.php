<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = array(
            [
                "dep_name_full" => "09.02.01 «Компьютерные системы и комплексы»",
                "qualification" => "Техник по комьютерным системам",
                "image" => "https://mpt.ru/upload/iblock/aee/%D0%91%D0%B5%D0%B7%20%D0%B8%D0%BC%D0%B5%D0%BD%D0%B8-1.jpg",
                "info" => json_encode([
                    "Профессиональные сертификации" => [
                        "Участник Microsoft IT Academy",
                        "Сертификация по продуктам Microsoft",
                        "Участник академии Касперского",
                        "Сертификация по антивирусным системам",
                        "Сертификация по официальным экзаменам компании Certiport"
                    ],
                    "Наши выпускники умеют" => [
                        "Пользоваться программами компьютерного графического дизайна", 
                        "Оформлять проектноконструктурскую и технологическую документацию",
                        "Владеть сетями ЭВМ и средствами связи",
                        "Пользоваться нормативной и справочной литературой для выбора устройств, материалов, оборудования, измерительных средств и д.р.",
                        "Осуществлять сборку, наладку, комплектование АТС",
                        "Владеть операционными системами и средами",
                        "Производить выбор и подключение периферийных устройств",
                        "Программировать микропроцессорные системы",
                        "Комплектовать, конфигурировать, настраивать компьютерные системы",
                        "ладеть языками программирования и системами реализации технологий, автоматизации расчетов обработки данных, учета, планирования и анализа",
                    ],
                    "На специальности изучаются" => [
                        "Языки программирования (Turbo Pascal, C++ Builder, Java, HTML и др.)", 
                        "Программное обеспечение (Windows, Unix)",
                        "Офисные пакеты (Access, Excel, Word)",
                        "Графические и анимационные пакеты (Adobe Photoshop, Flash, 3D MAX)",
                        "Микропроцессоры и микропроцессорные системы",
                        "Компьютерные сети и телекоммуникации", 
                        "Проводятся практики по профилю специальности, для получения проф. навыков: оператор ЭВМ, визуальные языки программирования, компановка ПЭВМ и другие"],
                    "text" => "Программа обучения предусматривает изучение архитектуры ЭВМ, периферийных устройств, системного, прикладного ПО, микропроцессорных цифровых устройств, средств обеспечения информационной безопасности в компьютерных системах, принципов построения компьютерных сетей, администрирования Windows, Unix."
                ]),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name_full" => "09.02.02 «Компьютерные сети»",
                "qualification" => "Техник по компьютерным сетям",
                "image" => "https://mpt.ru/upload/iblock/88b/2.jpg",
                "info" => json_encode([
                    "Профессиональные сертификации" => [
                        "Участник Microsoft IT Academy", 
                        "Сертификация по продуктам Microsoft",
                        "Участник академии Касперского",
                        "Сертификация по антивирусным системам",
                        "Обучение по международным учебным программам компании VMWare",
                        "Сертификация по официальным экзаменам компании Certiport"
                    ],
                    "Наши выпускники умеют" => [
                        "Ремонтировать и модернизировать ПК", 
                        "Проектировать и использовать локальные сети, интернет сайты",
                        "Работать с прикладными программами",
                        "Создавать собственные программные приложения",
                        "Диагностировать и контролировать работу компьютерных сетей",
                        "Сопровождать и администрировать сети",
                        "Комплектовать, конфигурировать, настраивать СВТ, компьютерные сети", 
                        "Устанавливать программное обеспечение", 
                    ],
                    "На специальности изучаются" => [
                        "Эксплуатация вычислительной техники", 
                        "Языки программирования (Delphi, Pascal, Assembler, C++Builder, Visual Basic, JAVA, HTML)", 
                        "Программное обучспечение ЭВМ (Windows, Unix, DOS, Internet Explorer)",
                        "Офисные программы(Access, Excel, Word, Power Point)",
                        "Графические и анимационные пакеты (Adobe Photoshop, Corel Draw, Gif Animator)",
                        "Аппаратные части (электроника, железо ПК, топология, архитектура и оборудование сетей)",
                        "Программное обеспечение компьютерных сетей (Windows, Linux)",
                        "Базовые языки программирования",
                        "Сетевые языки и серверные скрипты (HTML, PHP, Java, Javascript, XML)",
                        "Удаленные базы данных (MYSQL, MS SQL Server, FireBird)",
                        "Вопросы защиты и передачи информации в сетях"
                    ],
                    "text" => "Студенты изучают устройство и обслуживание локальных компьютерных сетей, установку и настройку аппаратных и программных средств доступа в сеть Интернет, информационную безопасность компьютеров и сетей, подключение и настройку сетевого оборудования, проведение диагностики и устранение неисправностей сетевого оборудования."
                ]),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name_full" => "09.02.03 «Программирование в компьютерных системах»",
                "qualification" => "Техник-программист",
                "image" => "https://mpt.ru/upload/iblock/bfe/1.jpg",
                "info" => json_encode([
                    "Профессиональные сертификации" => [
                        "Участник Microsoft IT Academy",
                        "Сертификация по продуктам Microsoft",
                        "Участник академии Касперского",
                        "Сертификация по антивирусным системам",
                        "Обучение по международным учебным программам компании VMWare",
                        "Участник образовательной инициативы Sybase. Проектирование корпоративных информационных систем: обучение и сертификация",
                        "Сертификация по официальным экзаменам компании Certiport"
                    ],
                    "Наши выпускники умеют" => [
                        "Свободно ориентироваться в мире компьютеров и компьютерных технологий",
                        "Совершенно владеть современным программным обеспечением",
                        "Самостоятельно создавать новые программные продукты",
                        "Использовать средства систем мультимедиа и компьютерной графики",
                        "Разрабатывать и обслуживать автоматизированные банковские технологии"
                    ],
                    "На специальности изучаются" => [
                        "Языки программирования('Паскаль','Ассемблер','Си')",
                        "Оператор ЭВМ",
                        "Базы данных",
                        "Технология разработки программных продуктов",
                        "Программное обеспечение компьютерных сетей",
                        "Преддипломная практика и стажировка"
                    ],
                    "text" => "В цикле профессиональных дисциплин студенты изучают безопасность информационных систем, техническое обслуживание и ремонт компьютеров, администрирование сетей, диагностику и системное программирование, WEB-дизайн и графическое моделирование объектов."
                ]),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name_full" => "09.02.04 «Информационные системы (по отраслям)»",
                "qualification" => "Техник по информационным системам",
                "image" => "https://mpt.ru/upload/iblock/33d/%D0%91%D0%B5%D0%B7%20%D0%B8%D0%BC%D0%B5%D0%BD%D0%B8-1.jpg",
                "info" => json_encode([
                    "Профессиональные сертификации" => [
                        "Обучение и международная сертификация MOS по продуктам Microsoft", 
                        "Обучение и международная сертификация MTA по технологиям Microsoft", 
                        "Обучение и сертификация по официальным курсам 1С",
                        "Обучение и сертификация по технологиям Oracle",
                        "Обучение и сертификация по технологиям Cisco",
                        "Сертификация по официальным экзаменам компании Certiport"
                    ],
                    "Наши выпускники умеют" => [
                        "Проектировать и развертывать информационные системы любого масштаба", 
                        "Администрировать, проектировать и создавать БД", 
                        "Разрабатывать современные программные продукты",
                        "Решать задачи безопасности информационных систем", 
                        "Свободно ориентироваться в вопросах управления, экономического планирования, математического моделирования"
                    ],
                    "На специальности изучаются" => [
                        "Информационные продукты и технологии (Microsoft, Adobe, Oracle, 1C)", 
                        "Базы данных и программирование (С++, C#, MS SQL, MySQL, Oracle, Access)", 
                        "Компьютерные сети и операционные системы",
                        "Технологии для создания интернет программ и вычислительных систем (HTML5, Javascript , PHP, ASP, .NET, Java)", 
                        "Компьютерная графика (Adobe Photoshop, Vectr, GIMP, Paint Tool)", 
                        "Серверные приложения (Apache, MS Interner Information Server)",
                        "Структура и методы проектирования АИС", 
                        "Архитектура и технические характеристики персональных компьютеров, сетевого оборудования и офисной техники", 
                        "Методы обеспечения информационной безопасности АИС"
                    ],
                    "text" => "Студенты изучают функционирование вычислительных систем, операционные системы, компьютерные сети, метрологию, стандартизацию, сертификацию и техническое документоведение. Среди профессиональных модулей — эксплуатация и модификация информационных систем (куда входят методы и средства их проектирования), участие в разработке информационных систем."
                ]),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name_full" => "09.02.05 «Прикладная информатика (по отраслям)»",
                "qualification" => "Техник-программист",
                "image" => "https://mpt.ru/upload/iblock/886/1.jpg",
                "info" => json_encode([
                    "Профессиональные сертификации" => [
                        "Участник Microsoft IT Academy", 
                        "Сертификация по продуктам Microsoft", 
                        "Обучение и сертификация по учебным программам компании 1С",
                        "Участник академии Касперского", 
                        "Сертификация по антивирусным системам", 
                        "Обучение работе с правовыми справочными системами Гарант и Консультант Плюс",
                        "Обучение и сертификация по учебным курсам компании Adobe", 
                        "Сертификация по официальным экзаменам компании Certiport"
                    ],
                    "Наши выпускники умеют" => [
                        "Отделы АСУ Банков и крупных промышленных предприятий", 
                        "Предприятия малого и среднего бизнеса", 
                        "Провайдерские организации",
                        "Вычислительные центры и др."
                    ],
                    "На специальности изучаются" => [
                        "Windows, Linux, Microsoft Office", 
                        "Borland C++,Visual Basic, C++ Bilder, Delphi", 
                        "HTML,PHPдля разработки интернет приложение",
                        "Язык SQL для работы с базами данных", 
                        "Разработка баз данных", 
                        "Информационная безопасность",
                        "1С: предприятие", 
                        "Основы теории информации", 
                        "Состав и принципы работы операционных систем и сред",
                        "Архитектура и технические характеристики профессиональных систем", 
                        "Методы прикладной информатики", 
                        "Внедрение и сопровождение профессионального ориентирования информационных систем в отрасли",
                        "Информационные и телекоммуникационные технологии"
                    ],
                    "text" => "Будущему технику-программисту нужно знать языки программирования, уметь создавать веб-страницы, владеть иностранным языком (английским как минимум). Студентов учат разрабатывать программы для различных целей и задач."
                ]),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name_full" => "09.02.06 «Сетевое и системное администрирование»",
                "qualification" => "Сетевой и системный администратор",
                "image" => "https://phototass3.cdnvideo.ru/width/1200_4ce85301/tass/m2/uploads/i/20180302/4659303.jpg",
                "info" => json_encode([
                    "Профессиональные сертификации" => [
                        "Участник сетевой академии Cisco", 
                        "Участник Microsoft IT Academy", 
                        "Сертификация по продуктам Microsoft",
                        "Участник академии Касперского", 
                        "Сертификация по антивирусным системам", 
                        "Обучение по международным учебным программам компании VMWare",
                        "Сертификация по официальным экзаменам компании Certiport"
                    ],
                    "Наши выпускники умеют" => [
                        "инсталлировать, тестировать, испытывать и использовать программные средства", 
                        "настраивать конкретные конфигурации операционных систем", 
                        "разрабатывать схемы баз данных",
                        "работать с современными системами программирования", 
                        "работать в среде различных операционных систем и администрировать их", 
                        "работать с локальными и глобальными сетями",
                        "ремонтировать и модернизировать ПК", 
                        "диагностировать и контролировать работу компьютерных сетей", 
                        "сопровождать и администрировать сети"
                    ],
                    "На специальности изучаются" => [
                        "Python", 
                        "HTML", 
                        "CSS",
                        "JS", 
                        "PHP", 
                        "SQL",
                        "PyCharm", 
                        "Visual Studio Code", 
                        "MySQL",
                        "MySQL Workbench PortgreS"
                    ],
                    "text" => "Отсутствует"
                ]),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name_full" => "09.02.07 «Информационные системы и программирование»",
                "qualification" => "Администратор баз данных Специалист по тестированию в области информационных технологий Программист Специалист по информационным системам Разработчик веб и мультимедийных приложений",
                "image" => "https://phototass3.cdnvideo.ru/width/1200_4ce85301/tass/m2/uploads/i/20180302/4659303.jpg",
                "info" => json_encode([
                    "text" => "Специальность охватывает достаточно широкий спектр сфер профессиональной деятельности, что позволяет получить знания о безопасности информационных систем, техническом обслуживании и ремонте компьютеров, администрировании сетей, прикладном и системном программировании, WEB-дизайне и графическом моделировании объектов. Позволяет получить опыт в разработке и интеграции модулей программного обеспечения, администрировании баз данных, сопровождении программного обеспечения"
                ]),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name_full" => "10.02.03 «Информационная безопасность автоматизированных систем»",
                "qualification" => "Техник по защите информации",
                "image" => "https://mpt.ru/upload/iblock/a16/4.jpg",
                "info" => json_encode([
                    "Наши выпускники умеют" => [
                        "Обеспечивать процесс защиты информации с использованием необходимых видов, методов, средств и технологий защиты", 
                        "Осуществлять учет, обработку, хранение, передачу, организацию использования различных носителей конфиденциальной информации", 
                        "Выявлять и блокировать каналы и методы несанкционированного доступа к информации, источники и способы дестабилизирующего воздействия на информацию",
                        "Устанавливать и адаптировать системы и средства обеспечения защиты информации", 
                        "Осуществлять контроль за качеством функционирования оборудования защищенных автоматизированных и телекоммуникационных систем, осуществлять анализ качественных и количественных показателей функционирования оборудования, осуществлять диагностику и устранение отказов, настройку и ремонт оборудования", 
                        "Участвовать в подготовке технической документации",
                        "Осуществлять техническую эксплуатацию на объектах профессиональной деятельности, предназначенных для сбора, обработки, хранения и передачи информации"
                    ],
                    "На специальности изучаются" => [
                        "Осуществлять техническую эксплуатацию на объектах профессиональной деятельности, предназначенных для сбора, обработки, хранения и передачи информации",
                        "Основы управленческой деятельности", 
                        "Правовое обеспечение информационной безопасности", 
                        "Электротехника",
                        "Электрорадиоизмерения", 
                        "Технические средства информатизации", 
                        "Основы алгоритмизации и программирования",
                        "Метрология, стандартизация и сертификация", 
                        "Инженерная графика", 
                        "Организационное обеспечение информационной безопасности",
                        "Технические методы и средства защиты информации", 
                        "Программно-аппаратные средства защиты информации", 
                        "Криптографические методы защиты информации",
                        "Экономика отрасли и др"
                    ],
                    "text" => "В профессиональном цикле дисциплин будущие специалисты по защите информации практикуются в языках программирования, проходят технологии и методы программирования, безопасность операционных систем и сетей."
                ]),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name_full" => "10.02.05 «Обеспечение информационной безопасности автоматизированных систем»",
                "qualification" => "Техник по защите информации",
                "image" => "https://phototass3.cdnvideo.ru/width/1200_4ce85301/tass/m2/uploads/i/20180302/4659303.jpg",
                "info" => json_encode([
                    "text" => "Участвует в работе по обеспечению информационной безопасности исследований и разработок, соблюдению государственной тайны. Осуществляет проверку технического состояния, установку, наладку и регулировку аппаратуры и приборов, их профилактические осмотры и текущий ремонт. Выполняет работы по эксплуатации средств защиты и контроля информации, следит за работой аппаратуры и другого оборудования. Ведет учет работ и объектов, подлежащих защите, установленных технических средств, журналы нарушений их работы, справочники. Готовит технические средства для проведения всех видов плановых и внеплановых контрольных проверок, аттестации оборудования, а также в случае необходимости к сдаче в ремонт. Проводит наблюдения, выполняет работу по оформлению протоколов специальных измерений и другой технической документации, в том числе отчетной, связанной с эксплуатацией средств и контроля информации. Выполняет необходимые расчеты, анализирует и обобщает результаты, составляет технические отчеты и оперативные сведения. Определяет причины отказов в работе технических средств, готовит предложения по их устранению и предупреждению, обеспечению высокого качества и надежности используемого оборудования, повышению эффективности мероприятий по контролю и защите информации. Участвует во внедрении разработанных технических решений и проектов, оказании технической помощи при изготовлении, монтаже, наладке, испытаниях и эксплуатации проектируемой аппаратуры"
                ]),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name_full" => "40.02.01 «Право и организация социального обеспечения»",
                "qualification" => "Юрист",
                "image" => "https://mpt.ru/upload/iblock/f65/3.jpg",
                "info" => json_encode([
                    "text" => "Важные предметы, которые предстоит изучить будущим юристам, — право социального обеспечения, финансовое, семейное, трудовое, экологическое, конституционное право, страховое дело, гражданский процесс."
                ]),
                "studysperiod" => "3 года 10 месяцев"
            ],
        );
        DB::table("departments")->insert($date);
    }
}