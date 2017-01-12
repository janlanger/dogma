<?php

namespace Dogma\Language;

/**
 * 2-letter language codes by ISO-639
 */
class Language extends \Dogma\Enum
{

    const ABKHAZ = 'ab';
    const AFAR = 'aa';
    const AFRIKAANS = 'af';
    const AKAN = 'ak';
    const ALBANIAN = 'sq';
    const AMHARIC = 'am';
    const ARABIC = 'ar';
    const ARAGONESE = 'an';
    const ARMENIAN = 'hy';
    const ASSAMESE = 'as';
    const AVARIC = 'av';
    const AVESTAN = 'ae';
    const AYMARA = 'ay';
    const AZERBAIJANI = 'az';
    const BAMBARA = 'bm';
    const BASHKIR = 'ba';
    const BASQUE = 'eu';
    const BELARUSIAN = 'be';
    const BENGALI = 'bn';
    const BIHARI = 'bh';
    const BISLAMA = 'bi';
    const BOSNIAN = 'bs';
    const BRETON = 'br';
    const BULGARIAN = 'bg';
    const BURMESE = 'my';
    const CATALAN = 'ca';
    const CHAMORRO = 'ch';
    const CHECHEN = 'ce';
    const CHICHEWA = 'ny';
    const CHINESE = 'zh';
    const CHURCH_SLAVIC = 'cu';
    const CHUVASH = 'cv';
    const CORNISH = 'kw';
    const CORSICAN = 'co';
    const CREE = 'cr';
    const CROATIAN = 'hr';
    const CZECH = 'cs';
    const DANISH = 'da';
    const DIVEHI = 'dv';
    const DUTCH = 'nl';
    const DZONGKHA = 'dz';
    const ENGLISH = 'en';
    const ESPERANTO = 'eo';
    const ESTONIAN = 'et';
    const EWE = 'ee';
    const FAROESE = 'fo';
    const FIJIAN = 'fj';
    const FINNISH = 'fi';
    const FRENCH = 'fr';
    const FULAH = 'ff';
    const GAELIC = 'gd';
    const GALICIAN = 'gl';
    const GANDA = 'lg';
    const GEORGIAN = 'ka';
    const GERMAN = 'de';
    const GREEK = 'el';
    const GUARANI = 'gn';
    const GUJARATI = 'gu';
    const HAITIAN = 'ht';
    const HAUSA = 'ha';
    const HEBREW = 'he';
    const HERERO = 'hz';
    const HINDI = 'hi';
    const HIRI_MOTU = 'ho';
    const HUNGARIAN = 'hu';
    const ICELANDIC = 'is';
    const IDO = 'io';
    const IGBO = 'ig';
    const INDONESIAN = 'id';
    const INTERLINGUA = 'ia';
    const INTERLINGUE = 'ie';
    const INUIT = 'iu';
    const INUPIAQ = 'ik';
    const IRISH = 'ga';
    const ITALIAN = 'it';
    const JAPANESE = 'ja';
    const JAVANESE = 'jv';
    const KALAALLISUT = 'kl';
    const KANNADA = 'kn';
    const KANURI = 'kr';
    const KASHMIRI = 'ks';
    const KAZAKH = 'kk';
    const KHMER = 'km';
    const KIKUYU = 'ki';
    const KINYARWANDA = 'rw';
    const KIRGHIZ = 'ky';
    const KIRUNDI = 'rn';
    const KOMI = 'kv';
    const KONGO = 'kg';
    const KOREAN = 'ko';
    const KUANYAMA = 'kj';
    const KURDISH = 'ku';
    const LAO = 'lo';
    const LATIN = 'la';
    const LATVIAN = 'lv';
    const LIMBURGISH = 'li';
    const LINGALA = 'ln';
    const LITHUANIAN = 'lt';
    const LUBA_KATANGA = 'lu';
    const LUXEMBOURGISH = 'lb';
    const MACEDONIAN = 'mk';
    const MALAGASY = 'mg';
    const MALAY = 'ms';
    const MALAYALAM = 'ml';
    const MALTESE = 'mt';
    const MANX = 'gv';
    const MAORI = 'mi';
    const MARATHI = 'mr';
    const MARSHALLESE = 'mh';
    const MOLDAVIAN = 'mo';
    const MONGOLIAN = 'mn';
    const NAURU = 'na';
    const NAVAJO = 'nv';
    const NDONGA = 'ng';
    const NEPALI = 'ne';
    const NORTHERN_SAMI = 'se';
    const NORTH_NDEBELE = 'nd';
    const NORWEGIAN = 'no';
    const NORWEGIAN_BOKMAL = 'nb';
    const NORWEGIAN_NYNORSK = 'nn';
    const OCCITAN = 'oc';
    const OJIBWA = 'oj';
    const ORIYA = 'or';
    const OROMO = 'om';
    const OSSETIAN = 'os';
    const PALI = 'pi';
    const PANJABI = 'pa';
    const PASHTO = 'ps';
    const PERSIAN = 'fa';
    const POLISH = 'pl';
    const PORTUGUESE = 'pt';
    const QUECHUA = 'qu';
    const RAETO_ROMANCE = 'rm';
    const ROMANIAN = 'ro';
    const RUSSIAN = 'ru';
    const RUSYN = 'ry';
    const SAMOAN = 'sm';
    const SANGO = 'sg';
    const SANSKRIT = 'sa';
    const SARDINIAN = 'sc';
    const SERBIAN = 'sr';
    const SERBO_CROATIAN = 'sh';
    const SHONA = 'sn';
    const SICHUAN_YI = 'ii';
    const SINDHI = 'sd';
    const SINHALA = 'si';
    const SLOVAK = 'sk';
    const SLOVENIAN = 'sl';
    const SOMALI = 'so';
    const SOUTHERN_SOTHO = 'st';
    const SOUTH_NDEBELE = 'nr';
    const SPANISH = 'es';
    const SUNDANESE = 'su';
    const SWAHILI = 'sw';
    const SWATI = 'ss';
    const SWEDISH = 'sv';
    const TAGALOG = 'tl';
    const TAHITIAN = 'ty';
    const TAJIK = 'tg';
    const TAMIL = 'ta';
    const TATAR = 'tt';
    const TELUGU = 'te';
    const THAI = 'th';
    const TIBETAN = 'bo';
    const TIGRINYA = 'ti';
    const TONGA = 'to';
    const TSONGA = 'ts';
    const TSWANA = 'tn';
    const TURKISH = 'tr';
    const TURKMEN = 'tk';
    const TWI = 'tw';
    const UIGHUR = 'ug';
    const UKRAINIAN = 'uk';
    const URDU = 'ur';
    const UZBEK = 'uz';
    const VENDA = 've';
    const VIETNAMESE = 'vi';
    const VOLAPUK = 'vo';
    const WALLOON = 'wa';
    const WELSH = 'cy';
    const WESTERN_FRISIAN = 'fy';
    const WOLOF = 'wo';
    const XHOSA = 'xh';
    const YIDDISH = 'yi';
    const YORUBA = 'yo';
    const ZHUANG = 'za';
    const ZULU = 'zu';

    /** @var string[] */
    private static $names = [
        self::ABKHAZ => 'abkhaz',
        self::AFAR => 'afar',
        self::AFRIKAANS => 'afrikaans',
        self::AKAN => 'akan',
        self::ALBANIAN => 'albanian',
        self::AMHARIC => 'amharic',
        self::ARABIC => 'arabic',
        self::ARAGONESE => 'aragonese',
        self::ARMENIAN => 'armenian',
        self::ASSAMESE => 'assamese',
        self::AVARIC => 'avaric',
        self::AVESTAN => 'avestan',
        self::AYMARA => 'aymara',
        self::AZERBAIJANI => 'azerbaijani',
        self::BAMBARA => 'bambara',
        self::BASHKIR => 'bashkir',
        self::BASQUE => 'basque',
        self::BELARUSIAN => 'belarusian',
        self::BENGALI => 'bengali',
        self::BIHARI => 'bihari',
        self::BISLAMA => 'bislama',
        self::BOSNIAN => 'bosnian',
        self::BRETON => 'breton',
        self::BULGARIAN => 'bulgarian',
        self::BURMESE => 'burmese',
        self::CATALAN => 'catalan',
        self::CHAMORRO => 'chamorro',
        self::CHECHEN => 'chechen',
        self::CHICHEWA => 'chichewa',
        self::CHINESE => 'chinese',
        self::CHURCH_SLAVIC => 'church slavic',
        self::CHUVASH => 'chuvash',
        self::CORNISH => 'cornish',
        self::CORSICAN => 'corsican',
        self::CREE => 'cree',
        self::CROATIAN => 'croatian',
        self::CZECH => 'czech',
        self::DANISH => 'danish',
        self::DIVEHI => 'divehi',
        self::DUTCH => 'dutch',
        self::DZONGKHA => 'dzongkha',
        self::ENGLISH => 'english',
        self::ESPERANTO => 'esperanto',
        self::ESTONIAN => 'estonian',
        self::EWE => 'ewe',
        self::FAROESE => 'faroese',
        self::FIJIAN => 'fijian',
        self::FINNISH => 'finnish',
        self::FRENCH => 'french',
        self::FULAH => 'fulah',
        self::GAELIC => 'gaelic',
        self::GALICIAN => 'galician',
        self::GANDA => 'ganda',
        self::GEORGIAN => 'georgian',
        self::GERMAN => 'german',
        self::GREEK => 'greek',
        self::GUARANI => 'guaraní',
        self::GUJARATI => 'gujarati',
        self::HAITIAN => 'haitian',
        self::HAUSA => 'hausa',
        self::HEBREW => 'hebrew',
        self::HERERO => 'herero',
        self::HINDI => 'hindi',
        self::HIRI_MOTU => 'hiri motu',
        self::HUNGARIAN => 'hungarian',
        self::ICELANDIC => 'icelandic',
        self::IDO => 'ido',
        self::IGBO => 'igbo',
        self::INDONESIAN => 'indonesian',
        self::INTERLINGUA => 'interlingua',
        self::INTERLINGUE => 'interlingue',
        self::INUIT => 'inuit',
        self::INUPIAQ => 'inupiaq',
        self::IRISH => 'irish',
        self::ITALIAN => 'italian',
        self::JAPANESE => 'japanese',
        self::JAVANESE => 'javanese',
        self::KALAALLISUT => 'kalaallisut',
        self::KANNADA => 'kannada',
        self::KANURI => 'kanuri',
        self::KASHMIRI => 'kashmiri',
        self::KAZAKH => 'kazakh',
        self::KHMER => 'khmer',
        self::KIKUYU => 'kikuyu',
        self::KINYARWANDA => 'kinyarwanda',
        self::KIRGHIZ => 'kirghiz',
        self::KIRUNDI => 'kirundi',
        self::KOMI => 'komi',
        self::KONGO => 'kongo',
        self::KOREAN => 'korean',
        self::KUANYAMA => 'kuanyama',
        self::KURDISH => 'kurdish',
        self::LAO => 'lao',
        self::LATIN => 'latin',
        self::LATVIAN => 'latvian',
        self::LIMBURGISH => 'limburgish',
        self::LINGALA => 'lingala',
        self::LITHUANIAN => 'lithuanian',
        self::LUBA_KATANGA => 'luba-katanga',
        self::LUXEMBOURGISH => 'luxembourgish',
        self::MACEDONIAN => 'macedonian',
        self::MALAGASY => 'malagasy',
        self::MALAY => 'malay',
        self::MALAYALAM => 'malayalam',
        self::MALTESE => 'maltese',
        self::MANX => 'manx',
        self::MAORI => 'māori',
        self::MARATHI => 'marathi',
        self::MARSHALLESE => 'marshallese',
        self::MOLDAVIAN => 'moldavian',
        self::MONGOLIAN => 'mongolian',
        self::NAURU => 'nauru',
        self::NAVAJO => 'navajo',
        self::NDONGA => 'ndonga',
        self::NEPALI => 'nepali',
        self::NORTHERN_SAMI => 'northern sami',
        self::NORTH_NDEBELE => 'north ndebele',
        self::NORWEGIAN => 'norwegian',
        self::NORWEGIAN_BOKMAL => 'norwegian bokmål',
        self::NORWEGIAN_NYNORSK => 'norwegian nynorsk',
        self::OCCITAN => 'occitan',
        self::OJIBWA => 'ojibwa',
        self::ORIYA => 'oriya',
        self::OROMO => 'oromo',
        self::OSSETIAN => 'ossetian',
        self::PALI => 'pāli',
        self::PANJABI => 'panjabi',
        self::PASHTO => 'pashto',
        self::PERSIAN => 'persian',
        self::POLISH => 'polish',
        self::PORTUGUESE => 'portuguese',
        self::QUECHUA => 'quechua',
        self::RAETO_ROMANCE => 'raeto-romance',
        self::ROMANIAN => 'romanian',
        self::RUSSIAN => 'russian',
        self::RUSYN => 'rusyn',
        self::SAMOAN => 'samoan',
        self::SANGO => 'sango',
        self::SANSKRIT => 'sanskrit',
        self::SARDINIAN => 'sardinian',
        self::SERBIAN => 'serbian',
        self::SERBO_CROATIAN => 'serbo-croatian',
        self::SHONA => 'shona',
        self::SICHUAN_YI => 'sichuan yi',
        self::SINDHI => 'sindhi',
        self::SINHALA => 'sinhala',
        self::SLOVAK => 'slovak',
        self::SLOVENIAN => 'slovenian',
        self::SOMALI => 'somali',
        self::SOUTHERN_SOTHO => 'southern sotho',
        self::SOUTH_NDEBELE => 'south ndebele',
        self::SPANISH => 'spanish',
        self::SUNDANESE => 'sundanese',
        self::SWAHILI => 'swahili',
        self::SWATI => 'swati',
        self::SWEDISH => 'swedish',
        self::TAGALOG => 'tagalog',
        self::TAHITIAN => 'tahitian',
        self::TAJIK => 'tajik',
        self::TAMIL => 'tamil',
        self::TATAR => 'tatar',
        self::TELUGU => 'telugu',
        self::THAI => 'thai',
        self::TIBETAN => 'tibetan',
        self::TIGRINYA => 'tigrinya',
        self::TONGA => 'tonga',
        self::TSONGA => 'tsonga',
        self::TSWANA => 'tswana',
        self::TURKISH => 'turkish',
        self::TURKMEN => 'turkmen',
        self::TWI => 'twi',
        self::UIGHUR => 'uighur',
        self::UKRAINIAN => 'ukrainian',
        self::URDU => 'urdu',
        self::UZBEK => 'uzbek',
        self::VENDA => 'venda',
        self::VIETNAMESE => 'vietnamese',
        self::VOLAPUK => 'volapük',
        self::WALLOON => 'walloon',
        self::WELSH => 'welsh',
        self::WESTERN_FRISIAN => 'western frisian',
        self::WOLOF => 'wolof',
        self::XHOSA => 'xhosa',
        self::YIDDISH => 'yiddish',
        self::YORUBA => 'yoruba',
        self::ZHUANG => 'zhuang',
        self::ZULU => 'zulu',
    ];

    /** @var string[] */
    private static $native = [
        self::ABKHAZ => 'аҧсуа',
        self::AFAR => 'afaraf',
        self::AFRIKAANS => 'afrikaans',
        self::AKAN => 'akan',
        self::ALBANIAN => 'shqip',
        self::AMHARIC => 'አማርኛ',
        self::ARABIC => '‫العربية‬',
        self::ARAGONESE => 'aragonés',
        self::ARMENIAN => 'հայերեն',
        self::ASSAMESE => 'অসমীয়া',
        self::AVARIC => 'авар мацӏ',
        self::AVESTAN => 'avesta',
        self::AYMARA => 'aymar aru',
        self::AZERBAIJANI => 'azərbaycan dili',
        self::BAMBARA => 'bamanankan',
        self::BASHKIR => 'башҡорт теле',
        self::BASQUE => 'euskara',
        self::BELARUSIAN => 'беларуская',
        self::BENGALI => 'বাংলা',
        self::BIHARI => 'भोजपुरी',
        self::BISLAMA => 'bislama',
        self::BOSNIAN => 'bosanski jezik',
        self::BRETON => 'brezhoneg',
        self::BULGARIAN => 'български език',
        self::BURMESE => 'burmese', ///
        self::CATALAN => 'català',
        self::CHAMORRO => 'chamoru',
        self::CHECHEN => 'нохчийн мотт',
        self::CHICHEWA => 'chicheŵa; chinyanja',
        self::CHINESE => '中文',
        self::CHURCH_SLAVIC => 'staroslověnština',
        self::CHUVASH => 'чӑваш чӗлхи',
        self::CORNISH => 'kernewek',
        self::CORSICAN => 'corsu',
        self::CREE => 'ᓀᐦᐃᔭᐍᐏᐣ',
        self::CROATIAN => 'hrvatski',
        self::CZECH => 'čeština',
        self::DANISH => 'dansk',
        self::DIVEHI => '‫ދިވެހި‬',
        self::DUTCH => 'nederlands',
        self::DZONGKHA => 'རྫོང་ཁ',
        self::ENGLISH => 'english',
        self::ESPERANTO => 'esperanto',
        self::ESTONIAN => 'eesti keel',
        self::EWE => 'ɛʋɛgbɛ',
        self::FAROESE => 'føroyskt',
        self::FIJIAN => 'vosa vakaviti',
        self::FINNISH => 'suomen kieli',
        self::FRENCH => 'français',
        self::FULAH => 'fulfulde',
        self::GAELIC => 'gàidhlig',
        self::GALICIAN => 'galego',
        self::GANDA => 'luganda',
        self::GEORGIAN => 'ქართული',
        self::GERMAN => 'deutsch',
        self::GREEK => 'ελληνικά',
        self::GUARANI => 'avañe\'ẽ',
        self::GUJARATI => 'ગુજરાતી',
        self::HAITIAN => 'kreyòl ayisyen',
        self::HAUSA => '‫هَوُسَ‬',
        self::HEBREW => '‫עברית‬',
        self::HERERO => 'otjiherero',
        self::HINDI => 'हिन्दी',
        self::HIRI_MOTU => 'hiri motu',
        self::HUNGARIAN => 'magyar',
        self::ICELANDIC => 'íslenska',
        self::IDO => 'ido',
        self::IGBO => 'igbo',
        self::INDONESIAN => 'bahasa indonesia',
        self::INTERLINGUA => 'interlingua',
        self::INTERLINGUE => 'interlingue',
        self::INUIT => 'ᐃᓄᒃᑎᑐᑦ',
        self::INUPIAQ => 'iñupiaq',
        self::IRISH => 'gaeilge',
        self::ITALIAN => 'italiano',
        self::JAPANESE => '日本語',
        self::JAVANESE => 'basa jawa',
        self::KALAALLISUT => 'kalaallisut',
        self::KANNADA => 'ಕನ್ನಡ',
        self::KANURI => 'kanuri',
        self::KASHMIRI => 'कश्मीरी; ‫كشميري‬',
        self::KAZAKH => 'қазақ тілі',
        self::KHMER => 'ភាសាខ្មែរ',
        self::KIKUYU => 'gĩkũyũ',
        self::KINYARWANDA => 'kinyarwanda',
        self::KIRGHIZ => 'кыргыз тили',
        self::KIRUNDI => 'kirundi',
        self::KOMI => 'коми кыв',
        self::KONGO => 'kikongo',
        self::KOREAN => '한국어',
        self::KUANYAMA => 'kuanyama',
        self::KURDISH => 'kurdî; ‫كوردی‬',
        self::LAO => 'ພາສາລາວ',
        self::LATIN => 'latine',
        self::LATVIAN => 'latviešu valoda',
        self::LIMBURGISH => 'limburgs',
        self::LINGALA => 'lingála',
        self::LITHUANIAN => 'lietuvių kalba',
        self::LUBA_KATANGA => 'luba-katanga',
        self::LUXEMBOURGISH => 'lëtzebuergesch',
        self::MACEDONIAN => 'македонски јазик',
        self::MALAGASY => 'malagasy fiteny',
        self::MALAY => 'bahasa melayu; ‫بهاس ملايو‬',
        self::MALAYALAM => 'മലയാളം',
        self::MALTESE => 'malti',
        self::MANX => 'ghaelg',
        self::MAORI => 'te reo māori',
        self::MARATHI => 'मराठी',
        self::MARSHALLESE => 'kajin m̧ajeļ',
        self::MOLDAVIAN => 'лимба молдовеняскэ',
        self::MONGOLIAN => 'монгол',
        self::NAURU => 'ekakairũ naoero',
        self::NAVAJO => 'diné bizaad; dinékʼehǰí',
        self::NDONGA => 'owambo',
        self::NEPALI => 'नेपाली',
        self::NORTHERN_SAMI => 'davvisámegiella',
        self::NORTH_NDEBELE => 'isindebele',
        self::NORWEGIAN => 'norsk',
        self::NORWEGIAN_BOKMAL => 'norsk bokmål',
        self::NORWEGIAN_NYNORSK => 'norsk nynorsk',
        self::OCCITAN => 'occitan',
        self::OJIBWA => 'ᐊᓂᔑᓈᐯᒧᐎᓐ',
        self::ORIYA => 'ଓଡ଼ିଆ',
        self::OROMO => 'afaan oromoo',
        self::OSSETIAN => 'ирон æвзаг',
        self::PALI => 'पािऴ',
        self::PANJABI => 'ਪੰਜਾਬੀ; ‫پنجابی‬',
        self::PASHTO => '‫پښتو‬',
        self::PERSIAN => '‫فارسی‬',
        self::POLISH => 'polski',
        self::PORTUGUESE => 'português',
        self::QUECHUA => 'runa simi; kichwa',
        self::RAETO_ROMANCE => 'rumantsch grischun',
        self::ROMANIAN => 'română',
        self::RUSSIAN => 'русский язык',
        self::RUSYN => 'русинськый язык',
        self::SAMOAN => 'gagana fa\'a samoa',
        self::SANGO => 'yângâ tî sängö',
        self::SANSKRIT => 'संस्कृतम्',
        self::SARDINIAN => 'sardu',
        self::SERBIAN => 'српски језик',
        self::SERBO_CROATIAN => 'српскохрватски',
        self::SHONA => 'chishona',
        self::SICHUAN_YI => 'ꆇꉙ',
        self::SINDHI => 'सिन्धी; ‫سنڌي، سندھی‬',
        self::SINHALA => 'සිංහල',
        self::SLOVAK => 'slovenčina',
        self::SLOVENIAN => 'slovenščina',
        self::SOMALI => 'soomaaliga; af soomaali',
        self::SOUTHERN_SOTHO => 'sesotho',
        self::SOUTH_NDEBELE => 'ndébélé',
        self::SPANISH => 'español',
        self::SUNDANESE => 'basa sunda',
        self::SWAHILI => 'kiswahili',
        self::SWATI => 'siswati',
        self::SWEDISH => 'svenska',
        self::TAGALOG => 'tagalog',
        self::TAHITIAN => 'reo mā`ohi',
        self::TAJIK => 'тоҷикӣ; toğikī; ‫تاجیکی‬',
        self::TAMIL => 'தமிழ்',
        self::TATAR => 'татарча; tatarça; ‫تاتارچا‬',
        self::TELUGU => 'తెలుగు',
        self::THAI => 'ไทย',
        self::TIBETAN => 'བོད་ཡིག',
        self::TIGRINYA => 'ትግርኛ',
        self::TONGA => 'faka tonga',
        self::TSONGA => 'xitsonga',
        self::TSWANA => 'setswana',
        self::TURKISH => 'türkçe',
        self::TURKMEN => 'türkmen; түркмен',
        self::TWI => 'twi',
        self::UIGHUR => 'uyƣurqə; ‫ئۇيغۇرچ ‬',
        self::UKRAINIAN => 'українська мова',
        self::URDU => '‫اردو‬',
        self::UZBEK => 'o\'zbek; ўзбек; ‫أۇزبېك‬',
        self::VENDA => 'tshivenḓa',
        self::VIETNAMESE => 'tiếng việt',
        self::VOLAPUK => 'volapük',
        self::WALLOON => 'walon',
        self::WELSH => 'cymraeg',
        self::WESTERN_FRISIAN => 'frysk',
        self::WOLOF => 'wollof',
        self::XHOSA => 'isixhosa',
        self::YIDDISH => '‫ייִדיש‬',
        self::YORUBA => 'yorùbá',
        self::ZHUANG => 'saɯ cueŋƅ',
        self::ZULU => 'isizulu',
    ];

    /**
     * @var string[]
     */
    private static $idents = [
        self::ABKHAZ => 'abkhaz',
        self::AFAR => 'afar',
        self::AFRIKAANS => 'afrikaans',
        self::AKAN => 'akan',
        self::ALBANIAN => 'albanian',
        self::AMHARIC => 'amharic',
        self::ARABIC => 'arabic',
        self::ARAGONESE => 'aragonese',
        self::ARMENIAN => 'armenian',
        self::ASSAMESE => 'assamese',
        self::AVARIC => 'avaric',
        self::AVESTAN => 'avestan',
        self::AYMARA => 'aymara',
        self::AZERBAIJANI => 'azerbaijani',
        self::BAMBARA => 'bambara',
        self::BASHKIR => 'bashkir',
        self::BASQUE => 'basque',
        self::BELARUSIAN => 'belarusian',
        self::BENGALI => 'bengali',
        self::BIHARI => 'bihari',
        self::BISLAMA => 'bislama',
        self::BOSNIAN => 'bosnian',
        self::BRETON => 'breton',
        self::BULGARIAN => 'bulgarian',
        self::BURMESE => 'burmese',
        self::CATALAN => 'catalan',
        self::CHAMORRO => 'chamorro',
        self::CHECHEN => 'chechen',
        self::CHICHEWA => 'chichewa',
        self::CHINESE => 'chinese',
        self::CHURCH_SLAVIC => 'church-slavic',
        self::CHUVASH => 'chuvash',
        self::CORNISH => 'cornish',
        self::CORSICAN => 'corsican',
        self::CREE => 'cree',
        self::CROATIAN => 'croatian',
        self::CZECH => 'czech',
        self::DANISH => 'danish',
        self::DIVEHI => 'divehi',
        self::DUTCH => 'dutch',
        self::DZONGKHA => 'dzongkha',
        self::ENGLISH => 'english',
        self::ESPERANTO => 'esperanto',
        self::ESTONIAN => 'estonian',
        self::EWE => 'ewe',
        self::FAROESE => 'faroese',
        self::FIJIAN => 'fijian',
        self::FINNISH => 'finnish',
        self::FRENCH => 'french',
        self::FULAH => 'fulah',
        self::GAELIC => 'gaelic',
        self::GALICIAN => 'galician',
        self::GANDA => 'ganda',
        self::GEORGIAN => 'georgian',
        self::GERMAN => 'german',
        self::GREEK => 'greek',
        self::GUARANI => 'guarani',
        self::GUJARATI => 'gujarati',
        self::HAITIAN => 'haitian',
        self::HAUSA => 'hausa',
        self::HEBREW => 'hebrew',
        self::HERERO => 'herero',
        self::HINDI => 'hindi',
        self::HIRI_MOTU => 'hiri-motu',
        self::HUNGARIAN => 'hungarian',
        self::ICELANDIC => 'icelandic',
        self::IDO => 'ido',
        self::IGBO => 'igbo',
        self::INDONESIAN => 'indonesian',
        self::INTERLINGUA => 'interlingua',
        self::INTERLINGUE => 'interlingue',
        self::INUIT => 'inuit',
        self::INUPIAQ => 'inupiaq',
        self::IRISH => 'irish',
        self::ITALIAN => 'italian',
        self::JAPANESE => 'japanese',
        self::JAVANESE => 'javanese',
        self::KALAALLISUT => 'kalaallisut',
        self::KANNADA => 'kannada',
        self::KANURI => 'kanuri',
        self::KASHMIRI => 'kashmiri',
        self::KAZAKH => 'kazakh',
        self::KHMER => 'khmer',
        self::KIKUYU => 'kikuyu',
        self::KINYARWANDA => 'kinyarwanda',
        self::KIRGHIZ => 'kirghiz',
        self::KIRUNDI => 'kirundi',
        self::KOMI => 'komi',
        self::KONGO => 'kongo',
        self::KOREAN => 'korean',
        self::KUANYAMA => 'kuanyama',
        self::KURDISH => 'kurdish',
        self::LAO => 'lao',
        self::LATIN => 'latin',
        self::LATVIAN => 'latvian',
        self::LIMBURGISH => 'limburgish',
        self::LINGALA => 'lingala',
        self::LITHUANIAN => 'lithuanian',
        self::LUBA_KATANGA => 'luba-katanga',
        self::LUXEMBOURGISH => 'luxembourgish',
        self::MACEDONIAN => 'macedonian',
        self::MALAGASY => 'malagasy',
        self::MALAY => 'malay',
        self::MALAYALAM => 'malayalam',
        self::MALTESE => 'maltese',
        self::MANX => 'manx',
        self::MAORI => 'aori',
        self::MARATHI => 'marathi',
        self::MARSHALLESE => 'marshallese',
        self::MOLDAVIAN => 'moldavian',
        self::MONGOLIAN => 'mongolian',
        self::NAURU => 'nauru',
        self::NAVAJO => 'navajo',
        self::NDONGA => 'ndonga',
        self::NEPALI => 'nepali',
        self::NORTHERN_SAMI => 'northern-sami',
        self::NORTH_NDEBELE => 'north-ndebele',
        self::NORWEGIAN => 'norwegian',
        self::NORWEGIAN_BOKMAL => 'norwegian-bokmal',
        self::NORWEGIAN_NYNORSK => 'norwegian-nynorsk',
        self::OCCITAN => 'occitan',
        self::OJIBWA => 'ojibwa',
        self::ORIYA => 'oriya',
        self::OROMO => 'oromo',
        self::OSSETIAN => 'ossetian',
        self::PALI => 'pali',
        self::PANJABI => 'panjabi',
        self::PASHTO => 'pashto',
        self::PERSIAN => 'persian',
        self::POLISH => 'polish',
        self::PORTUGUESE => 'portuguese',
        self::QUECHUA => 'quechua',
        self::RAETO_ROMANCE => 'raeto-romance',
        self::ROMANIAN => 'romanian',
        self::RUSSIAN => 'russian',
        self::RUSYN => 'rusyn',
        self::SAMOAN => 'samoan',
        self::SANGO => 'sango',
        self::SANSKRIT => 'sanskrit',
        self::SARDINIAN => 'sardinian',
        self::SERBIAN => 'serbian',
        self::SERBO_CROATIAN => 'serbo-croatian',
        self::SHONA => 'shona',
        self::SICHUAN_YI => 'sichuan-yi',
        self::SINDHI => 'sindhi',
        self::SINHALA => 'sinhala',
        self::SLOVAK => 'slovak',
        self::SLOVENIAN => 'slovenian',
        self::SOMALI => 'somali',
        self::SOUTHERN_SOTHO => 'southern-sotho',
        self::SOUTH_NDEBELE => 'south-ndebele',
        self::SPANISH => 'spanish',
        self::SUNDANESE => 'sundanese',
        self::SWAHILI => 'swahili',
        self::SWATI => 'swati',
        self::SWEDISH => 'swedish',
        self::TAGALOG => 'tagalog',
        self::TAHITIAN => 'tahitian',
        self::TAJIK => 'tajik',
        self::TAMIL => 'tamil',
        self::TATAR => 'tatar',
        self::TELUGU => 'telugu',
        self::THAI => 'thai',
        self::TIBETAN => 'tibetan',
        self::TIGRINYA => 'tigrinya',
        self::TONGA => 'tonga',
        self::TSONGA => 'tsonga',
        self::TSWANA => 'tswana',
        self::TURKISH => 'turkish',
        self::TURKMEN => 'turkmen',
        self::TWI => 'twi',
        self::UIGHUR => 'uighur',
        self::UKRAINIAN => 'ukrainian',
        self::URDU => 'urdu',
        self::UZBEK => 'uzbek',
        self::VENDA => 'venda',
        self::VIETNAMESE => 'vietnamese',
        self::VOLAPUK => 'volapuk',
        self::WALLOON => 'walloon',
        self::WELSH => 'welsh',
        self::WESTERN_FRISIAN => 'western-frisian',
        self::WOLOF => 'wolof',
        self::XHOSA => 'xhosa',
        self::YIDDISH => 'yiddish',
        self::YORUBA => 'yoruba',
        self::ZHUANG => 'zhuang',
        self::ZULU => 'zulu',
    ];

    public function getName(): string
    {
        return self::$names[$this->getValue()];
    }

    public function getNativeName(): string
    {
        return self::$native[$this->getValue()];
    }

    public function getIdent(): string
    {
        return self::$idents[$this->getValue()];
    }

    public function getByIdent(string $ident): self
    {
        self::get(array_search($ident, self::$idents));
    }

    public static function validateValue(&$value): bool
    {
        $value = strtolower($value);

        return parent::validateValue($value);
    }

}