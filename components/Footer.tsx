'use client';

import Link from 'next/link';

export function Footer() {
  return (
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
          <span className="muted">© {new Date().getFullYear()} EU KASKO</span>
        </div>
      </div>
    </footer>
  );
}
