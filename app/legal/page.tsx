import Link from 'next/link';

export const metadata = { title: 'Документы - EU KASKO' };

export default function LegalPage() {
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
            <h1>Документы и соглашения</h1>
            <div className="card">
              <h2>Политика конфиденциальности</h2>
              <p>Мы уважаем вашу приватность и защищаем личные данные в соответствии с законодательством РФ.</p>
              
              <h2>Условия использования</h2>
              <p>Используя наш сервис, вы согласны с данными условиями.</p>
              
              <h2>Договор страховки</h2>
              <p>Полный договор страховки предоставляется при оформлении полиса.</p>
            </div>
          </div>
        </section>
      </main>
    </>
  );
}
