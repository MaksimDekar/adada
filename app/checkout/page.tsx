import Link from 'next/link';

export const metadata = { title: 'Оформление полиса - EU KASKO' };

export default function CheckoutPage() {
  return (
    <>
      <header className="header">
        <div className="container header__inner">
          <Link href="/" className="brand">
            <span className="brand__logo">EU</span>
          </Link>
        </div>
      </header>

      <main id="content">
        <section className="section">
          <div className="container">
            <div className="page-head">
              <h1>Оформление полиса</h1>
            </div>

            <div className="card">
              <p>Форма оформления полиса:</p>
              <ol>
                <li>Заполните данные автомобиля</li>
                <li>Укажите персональные данные</li>
                <li>Выберите способ оплаты</li>
                <li>Получите полис по email</li>
              </ol>
              <Link href="/quote" className="btn btn--primary">Начать расчет заново</Link>
            </div>
          </div>
        </section>
      </main>
    </>
  );
}
