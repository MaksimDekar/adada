import Link from 'next/link';

export const metadata = {
  title: 'Планы страховки - EU KASKO',
};

export default function PlansPage() {
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
              <h1>Планы страховки</h1>
              <p className="muted">Выберите оптимальный план защиты для вашего авто</p>
            </div>

            <div className="grid3">
              <div className="plan-card">
                <h3>Basic</h3>
                <div className="plan-price">Базовый</div>
                <ul className="plan-features">
                  <li>✓ Страховка от повреждений</li>
                  <li>✓ Защита от кражи</li>
                  <li>✓ Техническая помощь 24/7</li>
                  <li>✓ Стандартная франшиза</li>
                </ul>
                <Link href="/quote" className="btn btn--primary btn--full">Рассчитать</Link>
              </div>

              <div className="plan-card plan-card--featured">
                <h3>Plus</h3>
                <div className="plan-price">Рекомендуемый</div>
                <ul className="plan-features">
                  <li>✓ Все как в Basic</li>
                  <li>✓ Защита стекол</li>
                  <li>✓ Помощь при ДТП</li>
                  <li>✓ Расширенная помощь</li>
                </ul>
                <Link href="/quote" className="btn btn--primary btn--full">Рассчитать</Link>
              </div>

              <div className="plan-card">
                <h3>Max</h3>
                <div className="plan-price">Максимальный</div>
                <ul className="plan-features">
                  <li>✓ Все как в Plus</li>
                  <li>✓ Защита от дорожных рисков</li>
                  <li>✓ Минимальная франшиза</li>
                  <li>✓ Приоритетная поддержка</li>
                </ul>
                <Link href="/quote" className="btn btn--primary btn--full">Рассчитать</Link>
              </div>
            </div>
          </div>
        </section>
      </main>
    </>
  );
}
