'use client';

import Link from 'next/link';

export default function Home() {
  const year = new Date().getFullYear();

  return (
    <>
      <a className="skip" href="#content">Перейти к содержимому</a>
      
      <header className="header">
        <div className="container header__inner">
          <Link className="brand" href="/">
            <span className="brand__logo">EU</span>
            <span className="brand__text">
              <strong>EU KASKO</strong>
              <small>• EU авто 2016–2025</small>
            </span>
          </Link>

          <nav className="nav" aria-label="Основная навигация">
            <button
              className="nav__burger"
              type="button"
              aria-label="Открыть меню"
              aria-expanded="false"
            >
              <span></span><span></span><span></span>
            </button>
            <ul className="nav__list">
              <li><Link className="nav__link" href="/">Главная</Link></li>
              <li><Link className="nav__link" href="/quote">Рассчитать</Link></li>
              <li><Link className="nav__link" href="/plans">Планы</Link></li>
              <li><Link className="nav__link" href="/about">Покрытие</Link></li>
              <li><Link className="nav__link" href="/guides">Полезное</Link></li>
              <li><Link className="nav__link" href="/faq">FAQ</Link></li>
              <li><Link className="nav__link" href="/contact">Контакты</Link></li>
              <li><Link className="nav__link" href="/legal">Документы</Link></li>
            </ul>
          </nav>

          <div className="header__actions">
            <Link
              className="btn btn--ghost"
              href="/lk"
            >Войти</Link>
            <button className="btn btn--ghost" data-theme-toggle type="button">
              <span className="icon">◐</span><span className="hide-sm">Тема</span>
            </button>
            <Link className="btn btn--primary" href="/quote">Рассчитать</Link>
          </div>
        </div>
      </header>

      <main id="content">
        <section className="hero">
          <div className="container hero__grid">
            <div className="hero__content reveal">
              <div className="chip">Европейские авто • 2016–2025 • ₽</div>
              <h1>Онлайн‑КАСКО для европейских авто</h1>
              <p className="lead">
                Рассчитайте стоимость, выберите план, оплатите — и полис появится
                в личном кабинете. Без лишних экранов: всё по шагам.
              </p>

              <ul className="list u-m14-0-0">
                <li>
                  <b>Планы:</b> Basic / Plus / Max — отличаются набором рисков и
                  сервисом.
                </li>
                <li>
                  <b>Опции:</b> угон/тотал, стёкла, помощь на дороге, франшиза.
                </li>
                <li>
                  <b>Документы:</b> условия и памятки — в разделе «Документы» и в
                  ЛК.
                </li>
              </ul>

              <div className="hero__cta">
                <Link className="btn btn--primary" href="/quote">Рассчитать</Link>
                <Link className="btn btn--ghost" href="/plans">Планы</Link>
                <Link className="btn btn--ghost" href="/about">Покрытие</Link>
              </div>

              <div className="hero__note">
                <span className="dot"></span>
                <span>
                  Поддержка через кнопку «Поддержка» вверху • Можно прикрепить
                  скрин
                </span>
              </div>
            </div>

            <div className="hero__card reveal">
              <div className="stack">
                <div className="card card--glass">
                  <div className="card__head">
                    <h3>Последний расчёт</h3>
                    <Link className="link" href="/quote">Открыть</Link>
                  </div>
                  <div id="lastQuote" className="last-quote">
                    <div className="skeleton"></div>
                    <div className="skeleton"></div>
                    <div className="skeleton"></div>
                  </div>
                  <div className="card__foot">
                    <Link
                      className="btn btn--primary btn--block"
                      href="/checkout"
                    >К оплате</Link>
                    <Link className="btn btn--ghost btn--block" href="/lk">
                      Личный кабинет
                    </Link>
                    <small className="muted">
                      Полис появится в ЛК после оформления.
                    </small>
                  </div>
                  <div className="media-slot" data-site-img="hero">
                    <div className="media-slot__ph">
                      Быстрое оформление полиса онлайн
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div className="hero__bg" aria-hidden="true"></div>
        </section>

        <section className="section">
          <div className="container">
            <div className="section__head reveal">
              <h2>Как это работает</h2>
              <p className="muted">
                Нормальный понятный процесс: план → расчёт → оплата → документы.
              </p>
            </div>

            <div className="grid3">
              <article className="card reveal">
                <h3 className="h3">1) Выберите план</h3>
                <p className="muted">
                  Basic — экономно, Plus — баланс, Max — максимум покрытия и
                  сервисов.
                </p>
                <Link className="link" href="/plans">Сравнить планы →</Link>
              </article>
              <article className="card reveal">
                <h3 className="h3">2) Рассчитайте</h3>
                <p className="muted">
                  Введите год/марку/модель, стоимость, стаж и опции. Сразу видно
                  разбивку цены.
                </p>
                <Link className="link" href="/quote">Открыть калькулятор →</Link>
              </article>
              <article className="card reveal">
                <h3 className="h3">3) Оформите</h3>
                <p className="muted">
                  Оплата картой/СБП/по счёту. После оформления данные появятся в
                  личном кабинете.
                </p>
                <Link className="link" href="/checkout">Перейти к оплате →</Link>
              </article>
            </div>

            <div className="banner reveal">
              <div>
                <h3 className="u-mb6">Нужна помощь?</h3>
                <p className="muted u-m0">
                  Нажмите «Поддержка» вверху — откроется форма, можно прикрепить
                  картинку.
                </p>
              </div>
              <div className="inline">
                <button className="btn btn--ghost" type="button" data-support-open>
                  Поддержка
                </button>
                <Link className="btn btn--primary" href="/quote">
                  Сделать расчёт
                </Link>
              </div>
            </div>
          </div>
        </section>

        <section className="section">
          <div className="container">
            <div className="section__head reveal">
              <h2>Покрытие и опции</h2>
              <p className="muted">
                Выбирайте то, что нужно именно вам: от базовых рисков до расширенной защиты.
              </p>
            </div>

            <div className="grid2">
              <article className="card reveal">
                <h3 className="h3">Основное покрытие</h3>
                <ul className="list">
                  <li>
                    <b>Столкновение</b> — защита от аварий с другими авто
                  </li>
                  <li>
                    <b>Наезд на препятствие</b> — падение предметов и столкновения с неподвижными объектами
                  </li>
                  <li>
                    <b>Стихия</b> — природные явления (град, наводнение, стихийные бедствия)
                  </li>
                  <li>
                    <b>Пожар и взрыв</b> — возгорание и взрывы
                  </li>
                </ul>
              </article>

              <article className="card reveal">
                <h3 className="h3">Опции</h3>
                <ul className="list">
                  <li>
                    <b>Угон/тотал</b> — полная потеря автомобиля
                  </li>
                  <li>
                    <b>Стёкла</b> — осколки и трещины на стёклах
                  </li>
                  <li>
                    <b>Помощь на дороге</b> — буксировка, техпомощь 24/7
                  </li>
                  <li>
                    <b>Франшиза</b> — снижает цену, часть расходов берёте на себя
                  </li>
                </ul>
              </article>
            </div>

            <div className="card__foot">
              <Link className="btn btn--primary btn--block" href="/plans">
                Сравнить планы
              </Link>
              <Link className="btn btn--ghost btn--block" href="/guides">
                Полезные материалы
              </Link>
            </div>
          </div>
        </section>

        <section className="section">
          <div className="container">
            <div className="section__head reveal">
              <h2>Полезное</h2>
              <p className="muted">
                Небольшие заметки, чтобы быстро разобраться в условиях и не
                потеряться при страховом случае.
              </p>
            </div>

            <div className="grid3">
              <article className="card reveal">
                <h3 className="h3">Как выбрать франшизу</h3>
                <p className="muted">
                  Когда выгодно брать франшизу и какую сумму выбрать, чтобы не
                  переплатить.
                </p>
                <Link className="link" href="/guides">Читать →</Link>
              </article>
              <article className="card reveal">
                <h3 className="h3">Что делать при ДТП</h3>
                <p className="muted">
                  Порядок действий: безопасность, фиксация, документы, обращение в
                  страховую.
                </p>
                <Link className="link" href="/guides">Читать →</Link>
              </article>
              <article className="card reveal">
                <h3 className="h3">Что влияет на цену</h3>
                <p className="muted">
                  Год, стоимость авто, стаж, опции, франшиза — и как это
                  отражается в расчёте.
                </p>
                <Link className="link" href="/guides">Читать →</Link>
              </article>
            </div>

            <div className="banner reveal">
              <div>
                <h3 className="u-mb6">Ещё вопросы?</h3>
                <p className="muted u-m0">
                  Мы собрали расширенный FAQ и краткие документы.
                </p>
              </div>
              <div className="inline">
                <Link className="btn btn--ghost" href="/faq">Открыть FAQ</Link>
                <Link className="btn btn--ghost" href="/legal">Документы</Link>
              </div>
            </div>
          </div>
        </section>
      </main>

      <footer className="footer">
        <div className="container footer__grid">
          <div>
            <div className="brand brand--footer">
              <span className="brand__logo">EU</span>
              <span className="brand__text">
                <strong>EU KASKO</strong>
                <small>Страховка для европейских авто (2016–2025)</small>
              </span>
            </div>
            <p className="muted">
              Оформление и поддержка онлайн. Все документы доступны в личном
              кабинете.
            </p>
          </div>
          <div className="footer__links">
            <Link href="/quote">Калькулятор</Link>
            <Link href="/plans">Планы</Link>
            <Link href="/about">Покрытие</Link>
            <Link href="/guides">Полезное</Link>
            <Link href="/contact">Контакты</Link>
            <Link href="/lk">Личный кабинет</Link>
          </div>
          <div className="footer__meta">
            <span className="muted">© <span id="yearNow">{year}</span> EU KASKO</span>
          </div>
        </div>
      </footer>
    </>
  );
}
