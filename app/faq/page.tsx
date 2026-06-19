import Link from 'next/link';

export const metadata = {
  title: 'FAQ - EU KASKO',
};

export default function FAQPage() {
  const faqs = [
    { q: 'Какие бренды автомобилей вы страхуете?', a: 'Мы работаем с европейскими брендами выпуска 2016-2025 года.' },
    { q: 'Какая минимальная стоимость полиса?', a: 'Минимальная стоимость зависит от модели авто и выбранного плана.' },
    { q: 'Как быстро получить полис?', a: 'Полис оформляется мгновенно после оплаты.' },
    { q: 'Какие способы оплаты вы принимаете?', a: 'Мы принимаем банковские карты и переводы.' },
  ];

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
              <h1>Часто задаваемые вопросы</h1>
            </div>
            <div className="card">
              {faqs.map((faq, i) => (
                <div key={i} className="faq-item">
                  <h3>{faq.q}</h3>
                  <p>{faq.a}</p>
                </div>
              ))}
            </div>
          </div>
        </section>
      </main>
    </>
  );
}
