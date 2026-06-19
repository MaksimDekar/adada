import Link from 'next/link';

export const metadata = {
  title: 'Покрытие - EU KASKO',
};

export default function AboutPage() {
  return (
    <>
      <header className="header">
        <div className="container header__inner">
          <Link href="/" className="brand">
            <span className="brand__logo">EU</span>
            <span className="brand__text"><strong>EU KASKO</strong></span>
          </Link>
          <div className="header__actions">
            <Link className="btn btn--primary" href="/quote">Рассчитать</Link>
          </div>
        </div>
      </header>

      <main id="content">
        <section className="section">
          <div className="container">
            <div className="page-head">
              <h1>Покрытие КАСКО</h1>
            </div>
            <div className="card">
              <h2>Что включает наша страховка</h2>
              <ul>
                <li>Защита от ДТП и столкновений</li>
                <li>Защита от кражи и угона</li>
                <li>Помощь при поломках</li>
                <li>Техническая помощь 24/7</li>
                <li>Буксировка и эвакуация</li>
              </ul>
            </div>
          </div>
        </section>
      </main>
    </>
  );
}
