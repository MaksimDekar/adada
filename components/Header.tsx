'use client';

import Link from 'next/link';

export function Header() {
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
            <Link className="btn btn--ghost" href="/lk">Войти</Link>
            <button className="btn btn--ghost" data-theme-toggle type="button">
              <span className="icon">◐</span><span className="hide-sm">Тема</span>
            </button>
            <Link className="btn btn--primary" href="/quote">Рассчитать</Link>
          </div>
        </div>
      </header>
    </>
  );
}
