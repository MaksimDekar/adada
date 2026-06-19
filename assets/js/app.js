(function () {
  'use strict';

  const CARS = {
    'Audi':['A3','A4','A6','Q3','Q5','Q7'],
    'BMW':['1 Series','3 Series','5 Series','X1','X3','X5'],
    'Mercedes-Benz':['A-Class','C-Class','E-Class','GLA','GLC','GLE'],
    'Volkswagen':['Golf','Passat','Tiguan','Touareg','Polo'],
    'Skoda':['Octavia','Superb','Karoq','Kodiaq','Fabia'],
    'SEAT':['Leon','Ibiza','Ateca','Arona','Tarraco'],
    'Porsche':['Macan','Cayenne','Panamera','911'],
    'Opel':['Astra','Insignia','Corsa','Grandland'],
    'Peugeot':['208','308','508','2008','3008'],
    'Citroen':['C3','C4','C5 Aircross','Berlingo'],
    'Renault':['Clio','Megane','Captur','Kadjar','Austral'],
    'Dacia':['Duster','Sandero','Logan'],
    'Fiat':['500','Tipo','Panda'],
    'Alfa Romeo':['Giulia','Stelvio','Tonale'],
    'Volvo':['S60','S90','XC40','XC60','XC90'],
    'Jaguar':['XE','XF','F-Pace','E-Pace'],
    'Land Rover':['Range Rover Evoque','Discovery Sport','Defender'],
    'MINI':['Hatch','Countryman','Clubman'],
    'Bentley':['Bentayga','Continental GT'],
    'Rolls-Royce':['Ghost','Cullinan'],
    'Aston Martin':['DB11','Vantage','DBX']
  };
  const PLAN_FACTORS = { basic: 0.95, plus: 1.08, max: 1.18 };

  const $ = (s, r=document) => r.querySelector(s);
  const $$ = (s, r=document) => Array.from(r.querySelectorAll(s));
  const fmt = (n) => Number.isFinite(Number(n)) ? new Intl.NumberFormat('ru-RU', { style:'currency', currency:'RUB', maximumFractionDigits:0 }).format(Number(n)) : '—';
  const prefix = () => location.pathname.match(/\/(pages|lk|admin|auth)\//) ? '../' : '';
  const query = new URLSearchParams(location.search);

  function setCookie(name, value) { document.cookie = name + '=' + encodeURIComponent(value) + ';path=/;max-age=31536000'; }
  function getCookie(name) {
    const row = document.cookie.split('; ').find(x => x.startsWith(name + '='));
    return row ? decodeURIComponent(row.split('=').slice(1).join('=')) : '';
  }

  function initTheme() {
    const saved = getCookie('eu_kasko_theme');
    if (saved === 'light') document.documentElement.setAttribute('data-theme', 'light');
    $$('[data-theme-toggle]').forEach(btn => btn.addEventListener('click', () => {
      const light = document.documentElement.getAttribute('data-theme') === 'light';
      if (light) { document.documentElement.removeAttribute('data-theme'); setCookie('eu_kasko_theme', 'dark'); }
      else { document.documentElement.setAttribute('data-theme', 'light'); setCookie('eu_kasko_theme', 'light'); }
    }));
  }

  function initCommon() {
    const year = $('#yearNow'); if (year) year.textContent = String(new Date().getFullYear());
    const burger = $('.nav__burger');
    const nav = $('.nav__list');
    if (burger && nav) burger.addEventListener('click', () => {
      const open = burger.getAttribute('aria-expanded') === 'true';
      burger.setAttribute('aria-expanded', String(!open));
      nav.classList.toggle('is-open', !open);
    });
    $$('.faq__q').forEach(btn => btn.addEventListener('click', () => {
      const open = btn.getAttribute('aria-expanded') === 'true';
      btn.setAttribute('aria-expanded', String(!open));
      const panel = btn.nextElementSibling;
      if (panel) panel.hidden = open;
    }));
    $$('.reveal').forEach(el => el.classList.add('is-in'));
    $$('[data-admin-link], [data-lk-link], .nav__link').forEach(a => {
      const current = location.pathname.split('/').pop() || 'index.php';
      if (a.getAttribute('href') && a.getAttribute('href').split('?')[0] === current) a.classList.add('is-active');
    });
    $('#download')?.addEventListener('click', () => window.print());
    $('#logoutBtn')?.addEventListener('click', () => { if ($('#logoutBtn').tagName === 'BUTTON') location.href = 'logout.php'; });
    $('#lkLogout')?.addEventListener('click', () => { if ($('#lkLogout').tagName === 'BUTTON') location.href = '../actions/logout.php'; });
  }

  async function initAuthLink() {
    const link = $('[data-auth-link]');
    if (!link) return;
    try {
      const r = await fetch(prefix() + 'api/session.php', { credentials:'same-origin' });
      const data = await r.json();
      if (data.logged) {
        link.textContent = 'Личный кабинет';
        link.href = link.dataset.authLk || prefix() + 'lk/index.php';
      }
    } catch (_) {}
  }

  function brandClass(brand) {
    if (['Porsche','Jaguar','Land Rover','Bentley','Rolls-Royce','Aston Martin','Mercedes-Benz','BMW','Audi'].includes(brand)) return 'premium';
    if (brand === 'Dacia') return 'budget';
    return 'standard';
  }
  function calcQuote() {
    const brand = $('#brand')?.value || '';
    const year = Number($('#year')?.value || new Date().getFullYear());
    const value = Number($('#value')?.value || 0);
    const exp = Number($('#exp')?.value || 0);
    const deductible = Number($('#deductible')?.value || 15000);
    if (!brand || !year || value < 200000) return null;
    const rates = { premium:0.065, standard:0.055, budget:0.048 };
    const cls = brandClass(brand);
    const age = Math.max(0, Math.min(12, new Date().getFullYear() - year));
    const ageFactor = 1 + age * 0.02;
    const expFactor = Math.max(0.85, Math.min(1.25, 1.25 - exp * 0.03));
    const dedFactor = ({0:1.15, 15000:1, 30000:0.92, 60000:0.82})[deductible] || 1;
    const addons = ($('#optTheft')?.checked ? 9000 : 0) + ($('#optGlass')?.checked ? 5000 : 0) + ($('#optRoad')?.checked ? 4000 : 0);
    const yearPrice = Math.round(value * rates[cls] * ageFactor * expFactor * dedFactor + addons);
    return { yearPrice, monthPrice: Math.round(yearPrice / 12), cls, addons };
  }

  function renderQuotePreview() {
    const q = calcQuote();
    const py = $('#priceYear'), pm = $('#priceMonth'), br = $('#breakdown'), elig = $('#eligibility');
    if (!py || !pm || !br || !elig) return;
    if (!q) {
      py.textContent = '—'; pm.textContent = '—'; elig.textContent = 'Проверка…';
      br.innerHTML = '<div class="muted">Заполните данные и нажмите «Посчитать».</div>';
      return;
    }
    py.textContent = fmt(q.yearPrice); pm.textContent = fmt(q.monthPrice); elig.textContent = 'Подходит';
    br.innerHTML = `
      <div class="row"><span class="muted">Класс бренда</span><b>${q.cls}</b></div>
      <div class="row"><span class="muted">Доп. опции</span><b>${fmt(q.addons)}</b></div>
      <div class="row"><span class="muted">После расчёта</span><b>можно перейти к оформлению</b></div>`;
  }

  function initQuote() {
    const yearSel = $('#year'), brandSel = $('#brand'), modelSel = $('#model'), exp = $('#exp'), expLabel = $('#expLabel');
    if (!yearSel || !brandSel || !modelSel) return;
    if (!yearSel.options.length) {
      yearSel.innerHTML = '<option value="">Выберите год</option>' + Array.from({length:10}, (_,i)=>2025-i).map(y=>`<option value="${y}">${y}</option>`).join('');
    }
    if (!brandSel.options.length) {
      brandSel.innerHTML = '<option value="">Выберите марку</option>' + Object.keys(CARS).map(b=>`<option value="${b}">${b}</option>`).join('');
    }
    function fillModels() {
      const brand = brandSel.value;
      modelSel.disabled = !brand;
      modelSel.innerHTML = brand ? '<option value="">Выберите модель</option>' + CARS[brand].map(m=>`<option value="${m}">${m}</option>`).join('') : '<option value="">Сначала марка</option>';
      renderQuotePreview();
    }
    brandSel.addEventListener('change', fillModels);
    $$('#quoteForm input, #quoteForm select').forEach(el => el.addEventListener('input', () => { if (exp && expLabel) expLabel.textContent = exp.value; renderQuotePreview(); }));
    fillModels();
    if (exp && expLabel) expLabel.textContent = exp.value;
    $('#saveQuote')?.addEventListener('click', () => $('#quoteForm')?.requestSubmit());
    $('#goCheckout')?.addEventListener('click', (e) => {
      const id = e.currentTarget.dataset.quoteId;
      if (id) location.href = 'checkout.php?quote_id=' + encodeURIComponent(id);
      else $('#quoteForm')?.requestSubmit();
    });
  }

  function initCheckout() {
    const form = $('#checkoutForm'); if (!form) return;
    const plan = $('#plan'), promo = $('#promo'), baseEl = $('[data-base-price]');
    const base = baseEl ? Number(baseEl.dataset.basePrice || 0) : 0;
    function update() {
      const key = plan?.value || 'plus';
      let total = Math.round(base * (PLAN_FACTORS[key] || 1.08));
      if ((promo?.value || '').trim().toUpperCase() === 'EU2026') total = Math.round(total * 0.95);
      if ($('#totalYear')) $('#totalYear').textContent = base ? fmt(total) : '—';
      if ($('#totalMonth')) $('#totalMonth').textContent = base ? fmt(Math.round(total / 12)) : '—';
    }
    plan?.addEventListener('change', update); promo?.addEventListener('input', update); update();
    $('#method')?.addEventListener('change', (e) => {
      const v = e.target.value;
      if ($('#payCard')) $('#payCard').hidden = v !== 'card';
      if ($('#paySbp')) $('#paySbp').hidden = v !== 'sbp';
      if ($('#payInvoice')) $('#payInvoice').hidden = v !== 'invoice';
    });
  }

  function initPlanButtons() {
    $$('[data-plan]').forEach(btn => btn.addEventListener('click', () => {
      location.href = 'quote.php?plan=' + encodeURIComponent(btn.dataset.plan || 'plus');
    }));
  }

  function initSupport() {
    const actions = $('.header__actions');
    if (actions && !actions.querySelector('[data-support-open]') && !location.pathname.includes('/admin/')) {
      const btn = document.createElement('button');
      btn.type = 'button'; btn.className = 'btn btn--ghost'; btn.dataset.supportOpen = '';
      btn.innerHTML = '<span class="icon">💬</span><span class="hide-sm">Поддержка</span>';
      actions.insertBefore(btn, actions.firstChild);
    }
    if ($('#supportBackdrop')) return;
    const backdrop = document.createElement('div');
    backdrop.className = 'modal-backdrop'; backdrop.id = 'supportBackdrop'; backdrop.setAttribute('aria-hidden','true');
    backdrop.innerHTML = `
      <div class="modal" role="dialog" aria-modal="true" aria-labelledby="supportTitle">
        <div class="modal__head"><div><h2 class="modal__title" id="supportTitle">Поддержка</h2><p class="muted" style="margin:6px 0 0;">Опишите вопрос — мы ответим как можно быстрее.</p></div><button class="modal__close" type="button" data-support-close>✕</button></div>
        <div class="modal__grid"><div><div class="contact-pill"><span class="muted">Email</span><b>support@eukasko.ru</b></div><div class="contact-pill" style="margin-top:10px;"><span class="muted">Телефон</span><b>8 (800) 000‑00‑00</b></div><div class="note" style="margin-top:12px;"><b>Можно прикрепить скрин.</b> Можно приложить изображение или скриншот.</div></div>
        <form id="supportForm" class="form" enctype="multipart/form-data"><div class="field"><label for="sName">Имя</label><input id="sName" name="name" placeholder="Как к вам обращаться" /></div><div class="field"><label for="sContact">Контакты</label><input id="sContact" name="contact" placeholder="Email или телефон" /></div><div class="field"><label for="sMsg">Сообщение</label><textarea id="sMsg" name="message" rows="5" required></textarea></div><div class="field"><label class="btn btn--ghost" style="cursor:pointer;justify-content:flex-start;">📎 Прикрепить картинку<input id="sFile" name="file" type="file" accept="image/*" hidden /></label><small class="hint" id="sFileHint"></small></div><div class="form__actions"><button class="btn btn--primary" type="submit">Отправить</button><button class="btn btn--ghost" type="button" data-support-close>Закрыть</button></div><div id="supportMsg" class="msg" role="status"></div></form></div>
      </div>`;
    document.body.appendChild(backdrop);
    const open = () => { backdrop.classList.add('is-open'); backdrop.setAttribute('aria-hidden','false'); document.body.style.overflow = 'hidden'; };
    const close = () => { backdrop.classList.remove('is-open'); backdrop.setAttribute('aria-hidden','true'); document.body.style.overflow = ''; };
    document.addEventListener('click', e => { if (e.target.closest('[data-support-open]')) { e.preventDefault(); open(); } if (e.target.closest('[data-support-close]')) { e.preventDefault(); close(); } });
    backdrop.addEventListener('click', e => { if (e.target === backdrop) close(); });
    $('#sFile')?.addEventListener('change', e => { const f = e.target.files && e.target.files[0]; if ($('#sFileHint')) $('#sFileHint').textContent = f ? 'Прикреплено: ' + f.name : ''; });
    $('#supportForm')?.addEventListener('submit', async e => {
      e.preventDefault();
      const msg = $('#supportMsg'); if (msg) msg.textContent = '';
      try {
        const res = await fetch(prefix() + 'api/support.php', { method:'POST', body:new FormData(e.currentTarget), credentials:'same-origin' });
        const data = await res.json();
        if (msg) { msg.textContent = data.message || (data.ok ? 'Отправлено' : 'Ошибка'); msg.classList.toggle('is-ok', !!data.ok); msg.classList.toggle('is-bad', !data.ok); }
        if (data.ok) e.currentTarget.reset();
      } catch (_) { if (msg) { msg.textContent = 'Ошибка отправки.'; msg.classList.add('is-bad'); } }
    });
  }

  function boot() {
    initTheme(); initCommon(); initAuthLink(); initQuote(); initCheckout(); initPlanButtons(); initSupport();
  }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', boot); else boot();
})();
