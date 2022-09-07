<?php

get_header();
?>

<div class="common-mv magazine-mv">
  <div class="common-top">
    <p class="common-top-title">MAIL MAGAZINE</p>
    <p class="common-top-subtitle">メルマガ登録</p>
  </div>
</div>

<p class="magazine-shortmessage">おすすめの記事やグッズ、イベント情報などを配信します。<br/>ぜひ、登録してTerravieの最新情報をGETしてください！</p>

<div class="magazine-register">
  <div class="magazine-register-inner">
    <form class="magazine-register-form">
      <div class="magazine-register-line">
        <p class="magazine-register-item">お名前</p>
        <div class="magazine-register-info">
          <input class="magazine-register-input" name="name" placeholder="苗字名前" />
          <p class="magazine-register-error magazine-register-error-name"></p>
        </div>
      </div>
      <div class="magazine-register-line">
        <p class="magazine-register-item">ふりがな</p>
        <div class="magazine-register-info">
          <input class="magazine-register-input" name="kana" placeholder="みょうじなまえ" />
          <p class="magazine-register-error magazine-register-error-kana"></p>
        </div>
      </div>
      <div class="magazine-register-line">
        <p class="magazine-register-item">メールアドレス</p>
        <div class="magazine-register-info">
          <input class="magazine-register-input" name="mail" placeholder="example@mail.com" />
          <p class="magazine-register-error magazine-register-error-mail"></p>
        </div>
      </div>
      <div class="magazine-register-line">
        <p class="magazine-register-item">生年月日</p>
        <div class="magazine-register-info">
          <p class="magazine-register-selectarea">
            <select class="magazine-register-input magazine-register-select" name="year">
              <?php 
              $y_today = intval(date('Y'));
              for($y = $y_today; $y >= 1900; $y--):
              ?>
              <option><?php echo $y; ?></option>
              <?php endfor; ?>
            </select>
          </p>
          <span>年</span>
          <p class="magazine-register-selectarea">
            <select class="magazine-register-input magazine-register-select" name="month">
              <option>12</option>
              <option>11</option>
              <option>10</option>
              <option>9</option>
              <option>8</option>
              <option>7</option>
              <option>6</option>
              <option>5</option>
              <option>4</option>
              <option>3</option>
              <option>2</option>
              <option>1</option>
            </select>
          </p>
          <span>月</span>
          <p class="magazine-register-selectarea">
            <select class="magazine-register-input magazine-register-select" name="date">
              <option>31</option>
              <option>30</option>
              <option>29</option>
              <option>28</option>
              <option>27</option>
              <option>26</option>
              <option>25</option>
              <option>24</option>
              <option>23</option>
              <option>22</option>
              <option>21</option>
              <option>20</option>
              <option>19</option>
              <option>18</option>
              <option>17</option>
              <option>16</option>
              <option>15</option>
              <option>14</option>
              <option>13</option>
              <option>12</option>
              <option>11</option>
              <option>10</option>
              <option>9</option>
              <option>8</option>
              <option>7</option>
              <option>6</option>
              <option>5</option>
              <option>4</option>
              <option>3</option>
              <option>2</option>
              <option>1</option>
            </select>
          </p>
          <span>日</span>
          <p class="magazine-register-error magazine-register-error-birthday"></p>
        </div>
      </div>
    </form>
  </div>
  <div class="common-button magazine-register-submit">メルマガ登録する<p class="common-button-arrow"></p></div>
  <p class="magazine-register-error magazine-register-error-all"></p>
</div>

<div class="magazine-unregister">
  <div class="magazine-unregister-inner">
    <p class="magazine-unregister-title">メルマガの解除について</p>
    <p class="magazine-unregister-text">過去にご登録いただいたメールアドレスをご入力いただき、「解除する」ボタンを押してください。</p>
    <form class="magazine-unregister-form">
      <div class="magazine-unregister-line">
        <p class="magazine-unregister-item">メールアドレス</p>
        <div class="magazine-unregister-info">
          <input class="magazine-unregister-input" name="mail" placeholder="example@mail.com" />
          <p class="magazine-unregister-error magazine-unregister-error-mail"></p>
        </div>
      </div>
    </form>
    <div class="common-button red magazine-unregister-submit">解除する<p class="common-button-arrow"></p></div>
    <p class="magazine-unregister-error magazine-unregister-error-all"></p>
  </div>
</div>

<?php

get_footer();
