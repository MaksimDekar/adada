import Link from 'next/link';

export const metadata = { title: 'Полезное - EU KASKO' };

export default function GuidesPage() {
  return (
    <>
      <header className="header">
        <div className="container header__inner">
          <Link href="/" className="brand">
            <span className="brand__logo">EU</span>
            <span className="brand__text"><strong>EU KASKO</strong></span>
          </Link>
        </div>
      </header>
      <main id="content">
        <section className="section">
          <div className="container">
            <h1>Полезные статьи</h1>
            <p>Приносим свои извинения, этот раздел в разработке.</p>
          </div>
        </section>
      </main>
    </>
  );
}
