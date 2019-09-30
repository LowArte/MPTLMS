<template>
    <div class="wrapper">
        <div class="error">
            <p>Отсутствует файл с расписанием!</p>
        </div>
        <div class="tworow">
            <div class="chislitel">
                <p>Числитель</p>
            </div> 

            <div class="buttons">
                <div class="loadschedule">
                    <p>Загрузить расписание</p>
                </div> 
                <div class="bsave">
                    <p>Сохранить</p>
                </div> 
            </div> 
        </div>
        <div class="dschedule">
            <table>
                <tr><th colspan="3">Понедельник</th></tr>
                <tr>
                    <td class="tid">№</td>
                    <td>Дисциплина</td>
                    <td class="tteacher">Преподаватель</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr><th colspan="3">Вторник</th></tr>
                <tr>
                    <td>1</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr><th colspan="3">Среда</th></tr>
                <tr>
                    <td>1</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr><th colspan="3">Четверг</th></tr>
                <tr>
                    <td>1</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr><th colspan="3">Пятница</th></tr>
                <tr>
                    <td>1</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr><th colspan="3">Суббота</th></tr>
                <tr>
                    <td>1</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script type="text/javascript">
    
</script>

<style scoped>
/***Общее***/
.wrapper{
    margin: 0px;
    padding: 0px;
    box-sizing: border-box;
    text-decoration: none;
    display: block;
    grid-template-rows: auto 100%;
}

/***Красное сообщение*/
.error{
    width: 75%;
    height: 60px;
    margin-top: 30px;
    margin-left: 30px;
    align-items: center;
    background: #ED6060;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
    border-radius: 3px;
}

.error p{
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 24px;
    line-height: 28px;
    text-align: left;
    color: #FFFFFF;
}
/***Числитель*/
.chislitel{
    width: 75%;
    height: 60px;
    margin-top: 10px;
    margin-left: 30px;
    
    background: #FFFFFF;
    border: 0.2px solid #7A7A7A;
    box-sizing: border-box;
    box-shadow: 0px 0px 6px rgba(0, 0, 0, 0.25);
    border-radius: 3px;
    display: inline-block;
}

.chislitel p{
    font-family: Roboto;
    font-style: normal;
    font-weight: 300;
    font-size: 36px;
    line-height: 42px;
    text-align: center;
    color: #000000;
}
/***tworow */
.tworow{
    height: 70px;
}
.buttons, .chislitel{
    display: inline-block;
}

.loadschedule{
    margin-top: 10px;
    margin-left: 10px;
    width: 100%;
    height: 20px;
    background: #FFFFFF;
    border: 0.2px solid #8D8D8D;
    box-sizing: border-box;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
    border-radius: 3px;
}
.bsave{
    margin-top: 10px;
    margin-left: 10px;
    width: 100%;
    height: 20px;
    background: rgba(119, 185, 79, 0.62);
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
    border-radius: 3px;
}

/***Таблица с расписанием */
.dschedule{
    width: 75%;
    margin-top: 40px;
    margin-left: 30px;
    
    background: #FFFFFF;
    border: 0.2px solid #7A7A7A;
    box-shadow: 0px 0px 6px rgba(0, 0, 0, 0.25);
}

table {
    width: 100%;
    font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    font-size: 14px;
    border-spacing: 0;
    border-style: solid;
    border-width: 1px;
    border-color: #000000;
}
th {
    background: #C4C4C4;
    padding: 10px 20px;
    text-align: left;
}
th, td {
    border-style: solid;
    border-width: 1px;
    border-color: #000000;

    font-family: Roboto;
    font-style: normal;
    font-weight: 300;
    font-size: 18px;
    line-height: 21px;
}

td {
    padding: 10px 20px;
    background: #FFFFFF;
    text-align: center;
}

.tid{
    width: 1%;
}

.tteacher{
    width: 19%;
}
</style>