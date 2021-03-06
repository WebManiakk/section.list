<?
/*ПРИМЕР СПИСКА
Array
(
    [ROOT] => Array
        (
            [CHILD] => Array
                (
                    [12] => Array
                        (
                            [ID] => 12
                            [~ID] => 12
                            [NAME] => Раздел с ид 12
                            [~NAME] => Раздел с ид 12
                            [DEPTH_LEVEL] => 1
                            [~DEPTH_LEVEL] => 1
                            [CHILD] => Array
                                (
                                    [63] => Array
                                        (
                                            [ID] => 63
                                            [~ID] => 63
                                            .............
                                            [CHILD] => Array
                                                (
                                                ........
                                                )
                                        )
                                     .......
                                    [63] => Array
                                        (
                                            [ID] => 63
                                            [~ID] => 63
                                            .............
                                        )
                                     .......
                                )
                        )
                 ..............
                )
        )
)
*/

$arFilter = array(
    'ACTIVE' => 'Y',
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'GLOBAL_ACTIVE'=>'Y',
);
$arSelect = array('IBLOCK_ID','ID','NAME','DEPTH_LEVEL','IBLOCK_SECTION_ID');
$arOrder = array('DEPTH_LEVEL'=>'ASC','SORT'=>'ASC');
$rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);
$sectionLinc = array();
$arResult['ROOT'] = array();
$sectionLinc[0] = &$arResult['ROOT'];
while($arSection = $rsSections->GetNext()) {
    $sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']] = $arSection;
    $sectionLinc[$arSection['ID']] = &$sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']];
}
unset($sectionLinc);
