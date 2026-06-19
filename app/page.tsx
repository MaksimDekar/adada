import Link from 'next/link';

export const metadata = {
  title: 'EU KASKO - Страховка для европейских авто',
  description: 'КАСКО для европейских автомобилей 2016-2025 года выпуска',
};

export default function Home() {
  return (
    <>
      <header className="header">
        <div className="container header__inner">
          <Link href="/" className="brand">
            <span className="brand__logo">EU</span>
            <span className="brand__text">
              <strong>EU KASKO</strong>
              <small>• EU авто 2016–2025</small>
            </span>
          </Link>

          <nav className="nav" aria-label="Основная навигация">
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
            <Link className="btn btn--ghost" href="/login">Войти</Link>
            <Link className="btn btn--primary" href="/quote">Рассчитать</Link>
          </div>
        </div>
      </header>

      <main id="content">
        <section className="section hero">
          <div className="container">
            <div className="hero__content reveal">
              <h1>КАСКО для европейских автомобилей</h1>
              <p className="h3">Надежная защита вашего авто от непредвиденных ситуаций</p>
              <Link className="btn btn--primary btn--lg" href="/quote">
                Рассчитать стоимость
              </Link>
            </div>
          </div>
        </section>

        <section className="section features">
          <div className="container">
            <h2>Почему EU KASKO?</h2>
            <div className="grid3">
              <div className="feature-card">
                <div className="feature-icon">✓</div>
                <h3>Быстрый расчет</h3>
                <p>Получите точную стоимость за 2 минуты</p>
              </div>
              <div className="feature-card">
                <div className="feature-icon">✓</div>
                <h3>Лучшие цены</h3>
                <p>Конкурентные ставки для вашего автомобиля</p>
              </div>
              <div className="feature-card">
                <div className="feature-icon">✓</div>
                <h3>24/7 Поддержка</h3>
                <p>Мы всегда готовы помочь вам</p>
              </div>
            </div>
          </div>
        </section>

        <section className="section cta">
          <div className="container">
            <h2>Готовы защитить свой автомобиль?</h2>
            <Link className="btn btn--primary btn--lg" href="/quote">
              Начать расчет
            </Link>
          </div>
        </section>
      </main>

      <footer className="footer">
        <div className="container footer__inner">
          <p>&copy; 2025 EU KASKO. Все права защищены.</p>
        </div>
      </footer>
    </>
  );
}
